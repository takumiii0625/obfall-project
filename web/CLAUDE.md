# OBFALL-PROJECT

Laravel 8 製サイト（obfall.com）を Next.js（React + TypeScript）へ移行中。
移行方針・決定事項は docs/MIGRATION.md、現行の画面仕様・工数は docs/migration-assessment.md を参照。

## ディレクトリ

- `./` 現行 Laravel（参照専用。変更しない）
- `./web/` 移行先 Next.js（App Router、TypeScript、Bootstrap 5）
- `./docs/` 移行方針・評価書・消費量記録

## 移行先（web/）の構成

- ページ: `web/src/app/(site)/<path>/page.tsx`（共通ヘッダー/フッター + globals.css を使う通常ページ）
  - `(site)/layout.tsx` がルートレイアウト（globals.css / Font Awesome Kit を読込）
  - `(standalone)/` は共通 CSS を一切読み込まない独立ページ用の別ルートレイアウト（人権方針のみ）
- 共通部品: `web/src/components/`（Header / Footer / PageHero / Breadcrumb / PrivacyPolicyText 等）
  - トップ専用: `web/src/components/top/`（HeroSection / SectionShapes / CharAnim / TopEffects）
- デザイントークン・グローバルCSS: `web/src/app/globals.css`（`--premium-*` 変数）
- DB: `web/src/db/schema.ts`（Drizzle スキーマ。列名は現行 MySQL と同一）、`web/src/db/index.ts`（`db()` 読み取り / `dbWrite()` 書き込み。DATABASE_URL のホストで Neon と ローカル pg を自動切替）
  - マイグレーション: `web/drizzle/`（`npm run db:generate` → `npm run db:migrate`）。シード: `npm run db:seed`（ローカル専用。TRUNCATE を伴う）
  - データアクセスは `web/src/lib/<table>.ts`（例: `lib/newses.ts`）に集約し、ページから直接 Drizzle を呼ばない
  - 日付整形は `web/src/lib/dates.ts`（JST）。ISR の秒数と再検証は `web/src/lib/revalidate.ts`
- モックデータ: `web/src/data/`（現在はシードの入力元としてのみ使用）
- メール: `web/src/lib/mail/contact-mail.ts`（本文・件名。純粋関数）、`web/src/lib/mail/send.ts`（Resend。API キー無しなら開発時ドライラン）
- スパム対策: `web/src/lib/turnstile.ts`（サーバー検証。鍵無しなら環境を問わずスキップし、ハニーポットのみで運用。キー2つを設定すると有効化）、`web/src/components/Turnstile.tsx`（ウィジェット）、ハニーポットは ContactForm 内
- 環境変数の一覧と用途は `web/.env.example` を正とする。新しい変数を足したら必ず追記する
- 管理画面（office）: `web/src/app/(admin)/`（独自ルートレイアウト。Sneat テンプレートの CSS は `web/public/backend/` にコピー済みで `<link>` で読む。公開側の globals.css は読まない）
  - `(guest)/` が未ログイン画面（ログイン / 初期設定 / PW 忘れ / PW 設定 / 各完了）、`(office)/` がログイン後画面（サイドメニュー + ヘッダー付き）
  - Sneat の JS（jQuery / menu.js / main.js 等）は `components/office/OfficeScripts.tsx` がハイドレーション後に順序どおり読み込む。素の `<script>` や `next/script` で足すとハイドレーション不一致になるので使わない
  - ログイン成功時は Server Action の `redirect()` ではなく LoginForm が `window.location` でフルページ遷移する（Sneat JS を確実に実行させるため）。ログイン後レイアウト内の遷移は `<Link>` / `redirect()` でよい
  - 認証系フォームの部品: `components/office/OfficeFormRow / OfficeAlert / OfficeCompleteCard`、state 型は `lib/office-form-state.ts`、Zod は `lib/office-auth-schema.ts`
  - PW 再設定: 署名付き URL は `lib/signed-url.ts`（HMAC、鍵は AUTH_SECRET、72h）、トークンは `admins.remember_token`。メール2通は `lib/mail/office-mail.ts`（HTML + text）。初期設定のメール DNS 検証は `lib/email-dns.ts`
  - 画像ストレージ: `lib/storage.ts`（Vercel Blob。`BLOB_READ_WRITE_TOKEN` 未設定なら開発は `public/uploads/` に保存し `uploads/<name>` を返す）。DB には Blob の完全 URL か `uploads/...` を保存し、表示は `resolveImageUrl` に通す
  - お知らせ CRUD: 一覧 `(office)/admins/newses`（検索・件数・ページは URL クエリ。戻るリンクは `back` パラメータで一覧クエリを持ち回る。URL 生成は `lib/office-news-links.ts`）、登録 `(office)/newses/create/input`、編集 `(office)/newses/[id]/edit/input`
    - 入力→確認→実行は `components/office/NewsForm.tsx` 1 コンポーネント（画像は File のまま state に持ち、実行時に Server Action へ送る）。Zod は `lib/news-schema.ts`、画像の検証・アップロード・後始末は `lib/news-images.ts`
    - 保存・削除後は必ず `revalidateNewsPages(id)`（`lib/revalidate.ts`）を呼ぶ
    - Server Action のボディ上限は next.config.ts の `experimental.serverActions.bodySizeLimit`（30mb）
  - 自社開発 CRUD: 一覧 `(office)/inhouse_developments`、詳細 `[id]`、登録 `create/input`、編集 `[id]/edit/input`。お知らせと同じ構成（`lib/development-schema.ts` / `lib/developments.ts` / `lib/office-development-links.ts` / `components/office/DevelopmentForm.tsx`）。画像は1枚で、公開側は DB を読まないため再検証は不要
  - 一覧の削除ボタン（`components/office/DeleteRowButton.tsx`）と公開ステータス・件数・ページャーの部品は両 CRUD で共用
  - 認証: Auth.js（Credentials、JWT Cookie、120分スライド）。`web/src/auth.ts`（照合・ロック判定）、`web/src/auth.config.ts`（DB 非依存部分。proxy と共有）、`web/src/proxy.ts`（ルートガード）
  - ログイン後ページは必ず `requireActiveAdmin()`（`web/src/lib/office-session.ts`）を呼ぶ（退職・削除済み管理者の強制ログアウト）
  - 管理者テーブルの操作は `web/src/lib/admins.ts`、パスワードは `web/src/lib/password.ts`（bcryptjs、`$2y$` 互換）
  - ローカルの管理者: `test@co.jp`（初期管理者 → /init/input）、`dev@example.com`（有効）。パスワードはどちらも `!Pass0120`（シード）
- バリデーション: `web/src/lib/contact-schema.ts`（Zod。クライアント・Server Action で同一スキーマを共有）
- Server Action: 画面ディレクトリ内の `actions.ts`（例: `app/(site)/contact/actions.ts`）。`"use server"` ファイルからは async 関数以外を export できないため、state 型・初期値・定数は隣の `*-state.ts` に置く
- 画像: `web/public/image/`（現行 `public/image/` から必要分のみコピー）

## リデザイン（redesign ブランチ。フェーズ1 = 土台 + トップ）

- 参考: `design/stitch/*.html`（Stitch 生成）と `design/stitch/DESIGN.md`。HTML と DESIGN.md が食い違えば HTML を正とする。Stitch のコードは貼らず React 部品として作り直す
- 文言は既存ページ（現行から移行済みのもの）を正とする。Stitch にだけある文言（CORPORATE EDITORIAL 等）は使わない
- スタイル: Tailwind CSS v4（`postcss.config.mjs` + `src/app/(redesign)/redesign.css` の `@theme`）。走査対象は `(redesign)` 配下と `components/redesign` のみ。Bootstrap・ページ固有 CSS は新デザインのページでは使わない
- ルート: `src/app/(redesign)/`（独自ルートレイアウト。next/font で Shippori Mincho B1 / Zen Kaku Gothic New / EB Garamond を供給）
  - 新デザイン済み（フェーズ1・2）: `/`、`/service`、`/service/contract`、`/achievements`、`/achievements/products`、`/philosophy`、`/aboutus`、`/contact`（入力・確認）、`/newses`、`/human-rights-policy`
  - 旧デザインのページは `(site)` / `(standalone)` のまま動く。置き換えた旧ページは各ディレクトリの `_legacy/`（`_` 付きで非ルーティング）に退避し、相対 import のパスだけ直してある。トップだけは `(site)/_legacy-top/`
  - 問い合わせの Server Action は既存 `(site)/contact/actions.ts` を新 ContactForm からも使う
  - Stitch に HTML が無いページ（service/products・ses・security、achievements/contract・security、newses/[id]、privacy-policy、complete）は未着手
- 共通部品: `components/redesign/`（Header = 現在地に青い下線、Footer（`showContactButton`）、PageHero（パンくず・英字ラベル・タイトル。和文は `jpTitle`）、Breadcrumb、TextLink「○○ →」、CardLink「詳しく見る」、LeadStatement（縦線 + 明朝の一文 + 本文）、SectionTitle（kicker + タイトル + 線）、BleedWord、Butterfly、ArrowIcon）
- 便利クラス: `wrap`（1180px 中央寄せ + 左右マージン）、`font-serif-jp` / `font-sans-jp` / `font-latin`、`p-space-*` / `px-margin`
- はみ出す装飾を持つセクションは `overflow-clip`（`overflow-hidden` だと scrollIntoView で横にずれる）
- アニメーションはフェーズ1では入れない。装飾は DESIGN.md のグラスモーフィズム等を採用せず、蝶・bleed word・翅の線のみ

## 作業ルール

- 現行 Laravel 側のコード・ファイルは変更しない
- 画面を移行するときは、対応する現行 Blade（`resources/views/...`）と
  docs/migration-assessment.md §2 の該当行だけを読む。評価書全体は読まない
- 読み込み除外: vendor/, node_modules/, public/backend/vendor/, public/js/app.js,
  public/css/app.css, public/uploads/, storage/, bootstrap/cache/
- 本番環境・本番DB・.env には触れない
- 見た目は現行と一致させることを優先。現行の不具合を見つけたら直さず「確認事項」として報告
- 静的ページはサーバーコンポーネント、フォームはクライアントコンポーネント + Server Actions
- 未確定の技術選定（ORM / 認証 / メール / ストレージ）は MIGRATION.md の「未定」欄を確認し、
  勝手に決めない
- 日本語で報告する。完了時は「作成ファイル一覧 / 現行との差分 / 次に再利用できる部品」を短く

## デプロイ（Vercel）

- チーム `obf-all`（takumiii0625's projects、Pro）/ プロジェクト `obfall-project`（Root Directory = `web`、Framework = Next.js）。本番 URL: https://obfall-project.vercel.app（独自ドメイン切替はフェーズ4）
- GitHub `takumiii0625/obfall-project` の `main` への push で本番デプロイ。CLI で再デプロイするときは `cd web && npx vercel redeploy <直近の本番デプロイURL> --scope obf-all`（`vercel deploy` を web/ から実行すると Root Directory 不一致で失敗する）
- Storage: Neon `obfall-db`（Marketplace、DATABASE_URL 等は自動注入）、Blob `obfall-uploads`（public、BLOB_READ_WRITE_TOKEN 自動注入）
- 本番 DB へのマイグレーション: `npx vercel env pull .env.production.local --environment production` → `DATABASE_URL=<DATABASE_URL_UNPOOLED の値> npx drizzle-kit migrate`（pooler ではなく unpooled を使う）
- 手動で入れた環境変数: AUTH_SECRET（Production / Preview 別値）、APP_URL、RESEND_API_KEY、CONTACT_MAIL_FROM / CONTACT_MAIL_TO（2026-09-26。現行踏襲で h.katono@obfall.co.jp）。未設定: NEXT_PUBLIC_TURNSTILE_SITE_KEY / TURNSTILE_SECRET_KEY（未設定の間は Turnstile を省略しハニーポットのみ。キー発行後に2つ揃えて追加）
- 独自ドメイン: obfall.com / www.obfall.com を 2026-09-30 にプロジェクトへ追加済み（DNS はムームードメイン。A 76.76.21.21 / www CNAME cname.vercel-dns.com を入れた時点で切替。切替後に APP_URL を https://obfall.com へ変更）
- `.env.local` は `vercel link` / `vercel env pull` で上書き追記されることがある。DATABASE_URL（ローカル pg）と AUTH_SECRET が残っているか確認する

## データ移行（フェーズ4 セッション14）

- 現行データは「複製」で移し、現行 MySQL / ロリポップ側には触れない（削除・停止は切替後に最後に行う）
- 画像: `cd web && npm run migrate:images`（`--dry-run` 可）。`../public/uploads/` の 11 件を Blob の `legacy/<名前>` に上書きアップロードし、`web/scripts/legacy-image-map.json`（`uploads/<元名>` → Blob URL）を更新する。2026-09-28 に実行済み
- データ: `cd web && npm run migrate:data -- --file=<ダンプ.sql> [--dry-run] [--tz=+09:00] [--tables=...]`。phpMyAdmin / mysqldump の INSERT を解析し、画像列を対応表で Blob URL に置換、DATETIME は `--tz`（既定 JST）の壁時計値として timestamptz に変換、id を保って UPSERT（再実行可。ダンプに無い行は消さない）、最後に identity を進める。Neon へは `ALLOW_MIGRATE_ON_NEON=1` と unpooled の DATABASE_URL を付けて実行する
- ダンプ入手: ロリポップの phpMyAdmin で newses / inhouse_developments / admins を SQL 形式でエクスポート（会社側の作業）。切替直前にもう一度取得して流し直す

## コマンド

- 開発: `cd web && npm run dev`（http://localhost:3000）。事前に `web/.env.local` の DATABASE_URL（ローカル: `postgresql://<user>@localhost:5432/obfall_dev`）と PostgreSQL の起動が必要
- 型チェック: `cd web && npx tsc --noEmit`
- Lint: `cd web && npm run lint`
