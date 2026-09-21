# OBFALL-PROJECT 移行アセスメント（タスク1）

- 作成日: 2026-09-21
- 対象: https://obfall.com/（Laravel 8 / Blade / Laravel Mix）
- 目的: React + TypeScript（Vercel）への完全移行に向けたコード調査と工数算出
- 本ドキュメントは調査結果の記録であり、既存コードは一切変更していない
- 「候補」として挙げた移行先は選択肢の列挙であり、決定は行っていない

---

## 1. 全体構成

### 1.1 ディレクトリ構成（自作コードのみ）

```
./
├── routes/web.php                 全ルート定義（56ルート）。api.php は雛形のみ
├── app/
│   ├── Http/Kernel.php            ミドルウェア登録
│   ├── Http/Controllers/
│   │   ├── TopController.php              トップページ（indexDev / 旧index）
│   │   ├── ContactsController.php         お問い合わせ（入力→確認→送信→完了）
│   │   ├── User/UserNewsesController.php  公開お知らせ一覧・詳細
│   │   ├── User/UserServicesController.php 公開サービス一覧
│   │   ├── Office/OfficeAuthController.php 管理者認証（ログイン/初期設定/PW再設定/ワンタイム）
│   │   ├── Office/OfficeNewsesController.php   お知らせCRUD
│   │   └── Office/OfficeDevelopmentsController.php 自社開発CRUD
│   ├── Http/Middleware/           自作3本 + Laravel標準7本
│   ├── Http/Requests/             FormRequest 9本 + カスタムRule 2本
│   ├── Mail/                      Mailable 7本
│   ├── Models/                    AdminModel / User / Contact（Contactは未使用）
│   ├── Enums/                     PerPage / PublishList
│   ├── Libraries/Utils.php        汎用ユーティリティ（多くは未使用）
│   └── Providers/                 Laravel標準（カスタマイズなし）
├── database/migrations/           admins / newses / inhouse_developments + Laravel標準4本
├── database/seeders/              初期管理者1件投入
├── resources/views/               Blade 60本（詳細は §1.4）
├── resources/css/app.css          自作CSS 2,839行（Mixで public/css/app.css にビルド）
├── resources/js/app.js            axios/lodash読込のみ（実質未使用）
├── public/js/main.js              公開側の自作JS 169行
├── public/backend/js/             管理画面テンプレート付属JS 11本（自作は script.js / product-form.js）
├── public/backend/vendor/         管理画面テンプレート同梱ライブラリ（読み込み対象外）
├── public/image/                  公開側画像 37ファイル
├── public/uploads/                 管理画面からのアップロード画像 11ファイル（中身未確認）
└── config/                        Laravel標準。auth / mail / session / filesystems のみ参照
```

### 1.2 エントリーポイントとルーティング

- エントリーポイントは `public/index.php`（Laravel標準）。全リクエストは `routes/web.php` に到達する。
- ルート定義は `routes/web.php` 1ファイルに56本。名前付きルートで統一されており、Blade側は `route('名前')` で参照している。
- ルートは3グループに分かれる。
  - **公開**: ミドルウェアなし。トップ、お知らせ、サービス、実績、会社概要、理念、問い合わせ、ポリシー
  - **管理・未ログイン用**: `RedirectIfAuthenticated:office` でガード。ログイン、初期設定、PW再設定、ワンタイムキー
  - **管理・ログイン後**: `RedirectIfNotAuthenticated:office` + `RedirectIfNoUser:office` でガード。お知らせCRUD、自社開発CRUD
- 静的ページ11本はコントローラを持たず、ルートのクロージャで直接 `view()` を返している。
- 管理画面のURLプレフィックスは不統一（一覧・詳細は `/admins/newses`、登録・編集は `/newses/create/...`、自社開発は `/inhouse_developments`）。
- `routes/api.php` は Sanctum の雛形ルート1本のみで、実質未使用。

### 1.3 共通処理

| 種別 | 実装箇所 | 内容 |
|---|---|---|
| ヘッダー | `components/header.blade.php` | ロゴ + PCナビ（5項目）+ ハンバーガーボタン。`<x-header />` で埋め込み |
| フッター | `components/footer.blade.php` | ロゴ / 住所 / 人権方針リンク / 問い合わせボタン。`<x-footer />` |
| ページヒーロー | `components/page-hero.blade.php` | タイトル + サブ + SVG背景。`variant` で10種の図形を切替（neural / hexgrid / launch / connect / shield / constellation / chart / structure / wave / mail / default） |
| モバイルナビ | 各ビューに直書き | `nav.nav-02` の5項目リストが全公開ビュー（19本）に重複記述されている |
| 管理レイアウト | `office/parts/app.blade.php` | 未ログイン時は認証カード、ログイン後はサイドメニュー + ヘッダーの2レイアウトを1ファイルで分岐 |
| 管理パーツ | `office/parts/side.blade.php` 他 | サイドメニュー / ヘッダー / alert / pagination |
| 認証 | `OfficeAuthController` + Middleware 3本 | セッション認証（guard `office`、provider `admins`）。詳細は §3.1 |
| DB接続 | `DB::table()` ファサード直書き | Eloquentモデルは認証用 `AdminModel` のみ。業務クエリは全てクエリビルダ |
| メール送信 | `Mail::to()->send()` | SMTP（`MAIL_MAILER=smtp`）。詳細は §3.3 |
| バリデーション | FormRequest 9本 + `$request->validate()` 1箇所 | 詳細は §3.5 |
| 画像アップロード | Controller内に直書き | `public/uploads/` へ `move()`。詳細は §3.4 |
| エラー表示 | `office/parts/item/alert.blade.php` | セッションの `success` / `error` を表示 |
| ページネーション | `office/parts/item/pagination.blade.php` / `pagination::bootstrap-4` | 管理は自作テンプレート、公開はLaravel標準 |
| セッション利用 | 各Controller | 入力→確認→実行の3段階フォームで入力値をセッションに保持。検索条件もセッション保持 |

### 1.4 Bladeビュー一覧（60本）と利用状況

| 区分 | 本数 | 備考 |
|---|---|---|
| 公開ページ（user/ + contacts/ + 直下） | 22 | うち **未使用4本**: `index.blade.php`（旧トップ、ルートはコメントアウト）、`layout.blade.php`、`welcome.blade.php`、`privacy_policy.blade.php`（**0バイトの空ファイルだがルートは有効**） |
| 共通コンポーネント | 3 | header / footer / page-hero |
| メールテンプレート | 2 + 4 | `mails/contact`、`mails/contact_to_company`、`office/**/notice` 3本、`office/signature` |
| 管理画面 | 33 | 認証11、お知らせ8、自社開発8、パーツ5、署名1 |

公開ページはレイアウト継承（`@extends`）を使っておらず、各ビューが `<!DOCTYPE html>` から完結している。`<head>` のCDN読込、`nav-02`、ページ固有の `<style>`（各150〜200行）が19本に重複している。

### 1.5 フロントエンド構成

- **CSS**: `resources/css/app.css`（2,839行、CSS変数ベースのデザイントークン定義あり）+ 各ビュー内のインライン `<style>`。管理画面は `public/backend/vendor/css/`（Sneat系テンプレート）。
- **CSSフレームワーク**: 公開側は Bootstrap 5.3.0（jsDelivr CDN）、管理側はテンプレート同梱の Bootstrap。旧レイアウト `layout.blade.php` のみ Bootstrap 4.5.2。
- **JS**: 公開側は jQuery 3.6.0（Google CDN）+ `public/js/main.js`（フェードイン、ハンバーガー、スムーススクロール、文字アニメーション、IntersectionObserver、SVGノード移動）。管理側はテンプレート同梱の jQuery / Popper / perfect-scrollbar / datepicker / apexcharts + 自作 `script.js`（削除確認、per_page切替、アコーディオン、郵便番号検索など。郵便番号検索はこのプロジェクトでは未使用）。
- **フォント**: Google Fonts（Inter / Noto Sans JP / Noto Serif JP、管理は Public Sans）。
- **アイコン**: Font Awesome Kit（`kit.fontawesome.com/1c70550d95.js`、アカウント紐付き）、Bootstrap Icons（CDN）、Boxicons（管理、ローカル）。
- **ビルド**: Laravel Mix（webpack）。`resources/css/app.css` → `public/css/app.css`、`resources/js/app.js` → `public/js/app.js`。
- **ローカル環境**: Laravel Sail（docker-compose に MySQL 8.0 / phpMyAdmin / Mailhog）。

---

## 2. 画面一覧

複雑度の基準: S = 静的または単純表示、M = フォーム・DB読み込み・状態あり、L = 検索/ページネーション/大量アニメーションなど複合。
「サーバー側処理」列は、React移行後もサーバー側に何らかの実装が必要な要素を示す。

### 2.1 公開画面

| # | URL | Bladeファイル | Controller・メソッド | 概要 | 利用者 | 複雑度 | 依存する共通処理 | サーバー側処理 |
|---|---|---|---|---|---|---|---|---|
| 1 | GET / | indexDev.blade.php | TopController@indexDev | トップ。ヒーロー（SVGパーティクル）、SERVICE/ACHIEVEMENTS/ABOUT/NEWS/RECRUIT セクション、エンディング | 公開 | L | header, footer, main.js（文字・スクロールアニメ） | DB読み: newses（公開のみ、最新3件表示）、inhouse_developments（取得するがビュー未使用） |
| 2 | GET /newses | user/newses/index.blade.php | UserNewsesController@index | お知らせ一覧。10件ページネーション、サムネイル | 公開 | M | header, footer, page-hero(wave) | DB読み: newses（status=1、deleted_at null）、ページネーション |
| 3 | GET /newses/{id} | user/newses/show.blade.php | UserNewsesController@show | お知らせ詳細。画像1枚 + 本文 | 公開 | M | header, footer, page-hero(wave) | DB読み: newses（**status条件なし**。未公開も直URLで閲覧可）、存在しない場合はリダイレクト |
| 4 | GET /service | user/services/show.blade.php | UserServicesController@show | サービス一覧（4事業カード） | 公開 | S | header, footer, page-hero(hexgrid) | DB読み: inhouse_developments を取得するが**ビューで未使用** |
| 5 | GET /service/products | user/services/products.blade.php | クロージャ | 自社開発サービス紹介 | 公開 | S | header, footer, page-hero(launch) | なし |
| 6 | GET /service/contract | user/services/contract.blade.php | クロージャ | 受託開発サービス紹介 | 公開 | S | header, footer, page-hero(connect) | なし |
| 7 | GET /service/ses | user/services/ses.blade.php | クロージャ | SES紹介 | 公開 | S | header, footer, page-hero(constellation) | なし |
| 8 | GET /service/security | user/services/security.blade.php | クロージャ | 脆弱性診断紹介 | 公開 | S | header, footer, page-hero(shield) | なし |
| 9 | GET /achievements | user/achievements/show.blade.php | クロージャ | 実績トップ（3領域カード） | 公開 | S | header, footer, page-hero(chart) | なし |
| 10 | GET /achievements/products | user/achievements/products.blade.php | クロージャ | 自社開発実績（digOn / ストパス / 農業DX） | 公開 | S | header, footer, page-hero(launch) | なし |
| 11 | GET /achievements/contract | user/achievements/contract.blade.php | クロージャ | 受託開発実績（CareerLog / NoaChoice） | 公開 | S | header, footer, page-hero(connect) | なし |
| 12 | GET /achievements/security | user/achievements/security.blade.php | クロージャ | 脆弱性診断実績 | 公開 | S | header, footer, page-hero(shield) | なし |
| 13 | GET /aboutus | user/aboutuses/show.blade.php | クロージャ | 会社概要。Google Maps 埋め込み | 公開 | S | header, footer, page-hero(structure) | なし（Google Maps iframe はクライアント側） |
| 14 | GET /philosophy | user/philosophy/show.blade.php | クロージャ | 企業理念（Vision / Mission / 3つの柱 / 由来） | 公開 | S | header, footer, page-hero(neural) | なし |
| 15 | GET /contact | contacts/contact.blade.php | ContactsController@contact | お問い合わせ入力 + プライバシーポリシー全文 + 同意チェック | 公開 | M | header, page-hero(mail), 独自フッター | old() による入力復元、バリデーションエラー表示 |
| 16 | POST /confirm | contacts/confirm.blade.php | ContactsController@confirm | 入力内容確認 | 公開 | M | header, page-hero(mail), 独自フッター | バリデーション（§3.5）、CSRF |
| 17 | POST /process | （画面なし） | ContactsController@process | 送信処理 → /complete へリダイレクト | 公開 | — | — | メール送信2通（§3.3）、CSRF。DB保存はコメントアウト済み |
| 18 | GET /complete | contacts/complete.blade.php | ContactsController@complete | 送信完了 | 公開 | S | header, page-hero(mail), 独自フッター | なし |
| 19 | GET /privacy-policy | privacy_policy.blade.php | クロージャ | **空ファイル（0バイト）**。白紙ページが返る | 公開 | S | なし | なし |
| 20 | GET /human-rights-policy | human-rights-policy.blade.php | クロージャ | 人権方針・相談窓口。共通ヘッダー/フッター不使用の独立ページ | 公開 | S | なし（独自CSS） | なし |

### 2.2 管理画面（未ログイン）

| # | URL | Bladeファイル | Controller・メソッド | 概要 | 利用者 | 複雑度 | 依存する共通処理 | サーバー側処理 |
|---|---|---|---|---|---|---|---|---|
| 21 | GET /office/login | office/auth/login/input.blade.php | OfficeAuthController@loginInput | 管理者ログイン | office | M | office/parts/app（認証レイアウト）, alert | — |
| 22 | POST /office/login | （画面なし） | OfficeAuthController@loginExecute | ログイン処理 | office | — | — | DB読み書き: admins、bcrypt照合、試行回数制限、ロック、セッション発行、初期管理者判定 |
| 23 | GET /init/input | office/auth/init/input.blade.php | OfficeAuthController@initInput | 初期管理者の氏名・メール・PW設定 | office | M | app, alert | セッション `firstAdmin` 必須 |
| 24 | POST /init/complete | （画面なし） | OfficeAuthController@initExecute | 初期設定処理 | office | — | — | DB書き: admins（name/email/password/activated_at）、トランザクション |
| 25 | GET /init/complete | office/auth/init/complete.blade.php | OfficeAuthController@initComplete | 初期設定完了 | office | S | app | セッション flush |
| 26 | GET /office/forgot/pw/input | office/auth/forgot/pw/input.blade.php | OfficeAuthController@forgotPwInput | PW再設定メール送信フォーム | office | M | app, alert | — |
| 27 | POST /office/forgot/pw/complete | （画面なし） | OfficeAuthController@forgotPwExecute | 再設定URL発行 | office | — | — | DB読み書き: admins（remember_token）、署名付きURL生成（72h）、メール送信（ForgotPwMail） |
| 28 | GET /office/forgot/pw/complete | office/auth/forgot/pw/complete.blade.php | OfficeAuthController@forgotPwComplete | 送信完了 | office | S | app | なし |
| 29 | GET /office/set/pw/input | office/auth/set/pw/input.blade.php | OfficeAuthController@setPwInput | 新PW入力（メールURLから遷移） | office | M | app, alert | 署名検証、token→admins照合、セッション保持 |
| 30 | POST /office/set/pw/complete | （画面なし） | OfficeAuthController@setPwExecute | PW更新 | office | — | — | DB書き: admins（password/remember_token=null/activated_at）、メール送信（SetPwMail） |
| 31 | GET /office/set/pw/complete | office/auth/set/pw/complete.blade.php | OfficeAuthController@setPwComplete | 完了 | office | S | app | セッション flush |
| 32 | GET /onetime/input | office/auth/login/onetime_key.blade.php | OfficeAuthController@onetimeInput | ワンタイムキー入力（**現在は到達不能**。ログイン処理のメール認証部分がコメントアウト） | office | M | app, alert | DB読み: admins |
| 33 | POST /onetime/complete | （画面なし） | OfficeAuthController@onetimeExecute | ワンタイムキー照合 | office | — | — | DB読み書き: admins（onetime_key）、再ログイン |
| 34 | GET /office/logout | （画面なし） | OfficeAuthController@logout | ログアウト → /office/login | office | — | — | セッション破棄 |

### 2.3 管理画面（ログイン後）

| # | URL | Bladeファイル | Controller・メソッド | 概要 | 利用者 | 複雑度 | 依存する共通処理 | サーバー側処理 |
|---|---|---|---|---|---|---|---|---|
| 35 | GET /admins/newses | office/newses/index.blade.php | OfficeNewsesController@index | お知らせ一覧。検索（タイトル/内容LIKE、公開ステータス）、表示件数切替、ページネーション | office | L | app, side, header, alert, pagination, script.js | DB読み: newses、ページネーション、検索条件のセッション保存 |
| 36 | GET /admins/newses/{id} | office/newses/show.blade.php | OfficeNewsesController@show | お知らせ詳細 | office | S | app, side, alert | DB読み: newses |
| 37 | GET /newses/create/input | office/newses/create/input.blade.php | OfficeNewsesController@createInput | 登録入力（画像3枚、プレビューJS） | office | M | app, side, alert | セッションからの入力復元 |
| 38 | POST /newses/create/confirm | office/newses/create/confirm.blade.php | OfficeNewsesController@createConfirm | 登録確認 | office | M | app, side | バリデーション、**画像アップロード（確認時点で保存）**、セッション保存 |
| 39 | POST /newses/create/complete | （画面なし） | OfficeNewsesController@createExecute | 登録実行 / 戻る | office | — | — | DB書き: newses insert、トランザクション |
| 40 | GET /newses/create/complete | office/newses/create/complete.blade.php | OfficeNewsesController@createComplete | 登録完了 | office | S | app, side | セッション削除 |
| 41 | GET /newses/{id}/edit/input | office/newses/edit/input.blade.php | OfficeNewsesController@editInput | 編集入力（画像2,3に削除チェック） | office | M | app, side, alert | DB読み: newses |
| 42 | POST /newses/{id}/edit/confirm | office/newses/edit/confirm.blade.php | OfficeNewsesController@editConfirm | 編集確認 | office | M | app, side | バリデーション、画像削除（unlink）、画像アップロード、セッション保存 |
| 43 | POST /newses/{id}/edit/complete | （画面なし） | OfficeNewsesController@editExecute | 編集実行 / 戻る | office | — | — | DB書き: newses update |
| 44 | GET /newses/{id}/edit/complete | office/newses/edit/complete.blade.php | OfficeNewsesController@editComplete | 編集完了 | office | S | app, side | セッション削除 |
| 45 | POST /newses/{id}/delete | （画面なし） | OfficeNewsesController@deleteExecute | 論理削除 | office | — | — | DB書き: newses（deleted_at） |
| 46 | GET /inhouse_developments | office/inhouse_developments/index.blade.php | OfficeDevelopmentsController@index | 自社開発一覧。検索・件数・ページネーション（#35と同構造） | office | L | app, side, header, alert, pagination, script.js | DB読み: inhouse_developments |
| 47 | GET /inhouse_developments/{id} | office/inhouse_developments/show.blade.php | OfficeDevelopmentsController@show | 自社開発詳細 | office | S | app, side, alert | DB読み |
| 48 | GET /inhouse_developments/create/input | office/inhouse_developments/create/input.blade.php | OfficeDevelopmentsController@createInput | 登録入力（カテゴリ/タイトル/画像1枚/内容/URL/公開） | office | M | app, side, alert | セッション復元 |
| 49 | POST /inhouse_developments/create/confirm | office/inhouse_developments/create/confirm.blade.php | OfficeDevelopmentsController@createConfirm | 登録確認 | office | M | app, side | バリデーション、画像アップロード、セッション保存 |
| 50 | POST /inhouse_developments/create/complete | （画面なし） | OfficeDevelopmentsController@createExecute | 登録実行 / 戻る | office | — | — | DB書き: insert |
| 51 | GET /inhouse_developments/create/complete | office/inhouse_developments/create/complete.blade.php | OfficeDevelopmentsController@createComplete | 登録完了 | office | S | app, side | セッション削除 |
| 52 | GET /inhouse_developments/{id}/edit/input | office/inhouse_developments/edit/input.blade.php | OfficeDevelopmentsController@editInput | 編集入力 | office | M | app, side, alert | DB読み |
| 53 | POST /inhouse_developments/{id}/edit/confirm | office/inhouse_developments/edit/confirm.blade.php | OfficeDevelopmentsController@editConfirm | 編集確認 | office | M | app, side | バリデーション、画像削除・アップロード、セッション保存 |
| 54 | POST /inhouse_developments/{id}/edit/complete | （画面なし） | OfficeDevelopmentsController@editExecute | 編集実行 / 戻る | office | — | — | DB書き: update |
| 55 | GET /inhouse_developments/{id}/edit/complete | office/inhouse_developments/edit/complete.blade.php | OfficeDevelopmentsController@editComplete | 編集完了 | office | S | app, side | セッション削除 |
| 56 | POST /inhouse_developments/{id}/delete | （画面なし） | OfficeDevelopmentsController@deleteExecute | 論理削除 | office | — | — | DB書き: deleted_at |

画面数の集計: 公開19画面（+処理1）、管理・未ログイン8画面（+処理6）、管理・ログイン後16画面（+処理8）。**画面43、処理のみ15**。

---

## 3. サーバー側処理の棚卸し

### 3.1 認証・認可

#### 3.1.1 認証方式

| 項目 | 現行実装 |
|---|---|
| ガード | `office`（session driver、provider `admins` → `AdminModel`）。`web` ガード（users）は定義のみで未使用 |
| セッション | `SESSION_DRIVER=file`（.env.example既定）、有効期限120分。本番の設定値は未確認 |
| パスワード | bcrypt（`Hash::make` / `Hash::check`）。ハッシュ接頭辞は `$2y$` |
| ログイン | メール + パスワード。`Auth::guard('office')->loginUsingId()` でセッション発行 |
| 初期管理者 | `activated_at IS NULL` の管理者はログイン成功後、`/init/input` へ強制遷移して氏名・メール・PWを再設定。シーダーで `test@co.jp` を投入 |
| 試行制限 | 失敗ごとにセッションで5秒間ブロック。セッション内カウンタが6回に達すると `admins.login_locked_at` に記録し1時間ロック |
| ワンタイムキー | コードは存在するが、ログイン処理内のメール送信部分がコメントアウトされており**現在は無効** |
| PW再設定 | ランダムトークン（10〜100文字）を `remember_token` に保存 + `URL::temporarySignedRoute`（72時間）。署名検証結果はセッションにキャッシュ |
| CSRF | Laravel標準 `VerifyCsrfToken`（除外なし）。全POSTフォームに `@csrf` |
| ログアウト | `Auth::logout()` + セッション flush |

#### 3.1.2 ミドルウェアの役割

| ミドルウェア | 適用先 | 役割 | 備考 |
|---|---|---|---|
| `RedirectIfAuthenticated:office` | 未ログイン用ルート群 | ログイン済みなら `/admins/newses` へ | — |
| `RedirectIfNotAuthenticated:office` | ログイン後ルート群 | 未ログインなら `/office/login` へ | — |
| `RedirectIfNoUser:office` | ログイン後ルート群 | 管理者が有効（activated_at あり、terminated_at / deleted_at なし）か毎リクエスト確認。無効ならログアウト | **ホスト名に `office` を含む場合のみ動作する**。`obfall.com` では判定がスキップされる |
| `Authenticate`（標準） | 未使用 | `route('login')` へリダイレクトするが該当ルートは存在しない | — |
| `VerifyCsrfToken` / `EncryptCookies` / `StartSession` / `ShareErrorsFromSession` | web グループ | Laravel標準 | — |
| `TrimStrings`（password除外）/ `ConvertEmptyStringsToNull` / `ValidatePostSize` / `TrustProxies` / `HandleCors` / `PreventRequestsDuringMaintenance` | グローバル | Laravel標準 | — |
| `TrustHosts` | 無効（コメントアウト） | — | — |

認可（ロール・権限）は存在しない。管理者は全員同一権限。

#### 3.1.3 移行先候補

- **セッション/認証基盤**: Auth.js（NextAuth）Credentials プロバイダ、Lucia Auth、iron-session による自前セッション、Supabase Auth、Clerk。Vercel Functions はステートレスなので、ファイルセッションは使えず Cookie（JWT または署名付きセッションID + DB）に置き換える必要がある。
- **パスワードハッシュ**: `bcryptjs` / `@node-rs/bcrypt` で既存 `$2y$` ハッシュを照合可能（`$2y$` → `$2b$` の接頭辞読み替えが必要な実装がある）。既存管理者のPWをそのまま引き継ぐか、初回リセットさせるかは要判断。
- **試行制限・ロック**: セッション内カウンタは Serverless で持てないため、`admins` テーブルの列（`login_locked_at` は既存、失敗回数列を追加）または Upstash Redis / Vercel KV。
- **PW再設定トークン**: 署名付きURLの代替として、ハッシュ化トークン + 有効期限列をDBに持つ方式、または JWT（有効期限付き）。
- **CSRF**: Next.js Server Actions の Origin 検証、または double-submit cookie。フレームワーク未確定のため候補のみ。
- **管理者有効判定**: ミドルウェア（Next.js middleware / Route Handler の共通ガード）で毎回DB確認するか、セッション発行時のみ確認するかは要判断。

### 3.2 DBアクセス

#### 3.2.1 テーブル一覧（migrationsより）

| テーブル | 用途 | 主な列 | 使用状況 |
|---|---|---|---|
| `admins` | 管理者マスター | id, name, email, password(TEXT), onetime_key, remember_token(TEXT), login_locked_at, created_at, activated_at, updated_at, terminated_at, deleted_at | 使用中 |
| `newses` | お知らせ | id, title, content(TEXT), news_image_url_1〜3, status(0/1, default 1), notes, created_at, updated_at, deleted_at | 使用中 |
| `inhouse_developments` | 自社開発 | id, category, title, content, inhouse_developments_image_url, inhouse_developments_home_page_url, status, notes, created_at, updated_at, deleted_at | 使用中 |
| `users` / `password_resets` / `failed_jobs` / `personal_access_tokens` | Laravel標準 | — | 未使用（`User` モデル・Sanctum は雛形のまま） |
| （`contacts`） | 問い合わせ保存 | `Contact` モデルのみ存在。migration なし | 未使用（保存処理はコメントアウト） |

- 全テーブルとも `DB::statement` の生SQLで作成（MySQL固有: `ON UPDATE CURRENT_TIMESTAMP`、utf8mb4_unicode_ci、COMMENT）。
- 外部キー・インデックス（主キー以外）なし。
- 論理削除は `deleted_at` を手動で扱う（Eloquent SoftDeletes 不使用）。

#### 3.2.2 クエリの特徴

| 箇所 | 内容 |
|---|---|
| 公開トップ / お知らせ一覧 / サービス | `status=1 AND deleted_at IS NULL ORDER BY id DESC`。`DATE_FORMAT(created_at, "%Y年%m月%d日")` をSQL側で整形 |
| 公開お知らせ詳細 | `id` と `deleted_at IS NULL` のみ。**`status` 条件なし** |
| 管理一覧 | `title LIKE %x%`、`content LIKE %x%`、`status =`（ビューはチェックボックス配列 `status[]` を送るが、コントローラは単一値として `where('status', $request->status)` に渡している）。`paginate(per_page)`、per_page は 20〜300 に丸め |
| 登録・更新・削除 | `DB::beginTransaction` + `insert` / `update`。`QueryException` と `\Throwable` を捕捉してロールバック + `Log::error` |
| 認証 | `admins` を email / remember_token / onetime_key で検索 |

#### 3.2.3 移行先候補

- **DBサービス**: Vercel Postgres（Neon）、Supabase（Postgres）、PlanetScale（MySQL互換）、Turso（SQLite）、外部レンタルMySQLの継続利用（ロリポップDBは外部接続不可の場合が多く要確認）。
- **アクセス層**: Prisma、Drizzle ORM、Kysely。MySQL固有の `DATE_FORMAT` はアプリ側の日付整形に置き換える。
- **代替案**: お知らせ・自社開発をヘッドレスCMS（microCMS、Newt、Contentful、Sanity）へ移し、管理画面（#35〜#56）の自作を省く案。管理画面の工数を大幅に削減できる一方、既存の管理UI・運用フローは変わる。
- **データ移行**: 現行MySQLからのダンプ→変換→投入。件数規模は不明（§7）。

### 3.3 メール送信

#### 3.3.1 Mailable 7本の用途

| クラス | 用途 | 宛先 / 差出人 | テンプレート | 状態 |
|---|---|---|---|---|
| `ContactMail`（`mails.contact`） | 問い合わせ者向け自動返信 | To: 入力メール / From: `h.katono@obfall.co.jp`（OBFall株式会社） | text | **使用中** |
| `ContactMail`（`mails.contact_to_company`） | 会社向け通知 | To: `h.katono@obfall.co.jp` / From: 同上（表示名は入力会社名） / Reply-To: 入力メール | text | **使用中** |
| `Office\ForgotPwMail` | PW再設定URL通知（72h） | To: 管理者 | `office/auth/forgot/pw/notice` | **使用中** |
| `Office\SetPwMail` | PW変更完了通知 | To: 管理者 | `office/auth/set/pw/notice` | 使用中だが、テンプレートが存在しない `user/signature` を include しており**送信時に例外が発生する可能性が高い**（未検証） |
| `Office\OnetimeKeyMail` | ワンタイムキー通知 | To: 管理者 | `office/auth/login/notice` | 呼び出し元がコメントアウト。文面に「NoaChoice」と他プロジェクト名が残存 |
| `Office\AdminCreateMail` | 管理者作成通知 | — | `office/admins/create/notice`（**存在しない**） | 未使用 |
| `Office\AdminEstimateMail` | 見積通知 | — | `office/products/estimates/notice`（**存在しない**） | 未使用 |
| `Office\DeliveryUpdateMail` | 配送更新通知 | — | `office/purchases/notice`（**存在しない**） | 未使用 |

`ContactMail` は1クラスでテンプレート名により2用途を切り替える。Mail 7本のうち**実質必要なのは4通り**（問い合わせ2通 + PW再設定2通）。

- 送信方式: `MAIL_MAILER=smtp`。本番SMTPの設定（ロリポップのSMTPか外部か）は未確認。
- 宛先・差出人アドレスがコードにハードコードされている。
- `Utils::sendmail()`（`mb_send_mail` 直接呼び出し）も存在するが未使用。

#### 3.3.2 移行先候補

- Resend、SendGrid、Amazon SES、Mailgun、Postmark、Brevo。いずれも Vercel Functions から HTTP API で送信可能。
- 差出人 `obfall.co.jp` ドメインの SPF / DKIM / DMARC 設定が必要（ムームードメインのDNSで設定）。
- テンプレートは React Email、または文字列テンプレートで再実装。

### 3.4 ファイルアップロード

| 項目 | 現行実装 |
|---|---|
| 対象 | お知らせ画像3枚、自社開発画像1枚 |
| 保存先 | `public/uploads/`（Webサーバのローカルディスク）。現在11ファイル |
| ファイル名 | `time() . '_' . 元ファイル名` |
| DB保存値 | `uploads/xxx.jpg`（相対パス）。表示時は `asset()` で絶対URL化 |
| タイミング | **確認画面表示時点で保存**する（実行前に「戻る」やブラウザ離脱をしても残る） |
| 検証 | FormRequest の `max:8192` は**文字列長の検証**であり、ファイルサイズ・MIME の検証はない（`Utils::isAllowedExtension` / `uploadSize` は未使用） |
| 削除 | 編集確認時に `unlink()`。お知らせ画像2の削除判定はキー名の綴りが `delete_news_mage_url_2` と誤っており、**削除が機能しない**と見られる |
| S3 | `Utils` に S3 用メソッドがあるが未使用。`filesystems.php` は local が既定 |

移行先候補:
- Vercel Blob、Cloudflare R2、Amazon S3、Supabase Storage、Cloudinary。Vercel のファイルシステムは書き込み不可のため、外部オブジェクトストレージが必須。
- 既存11ファイルの移設と、DBの `uploads/...` 相対パスを新URLに書き換える（または表示時にプレフィックス付与する）方針の検討。
- アップロード経路は、サーバー経由（Route Handler）とクライアント直接署名付きアップロードの2案。

### 3.5 バリデーション

| Request / 箇所 | 対象 | ルール |
|---|---|---|
| `ContactsController@confirm`（inline） | 問い合わせ | name: required, max:10 / email: required, email / tel: nullable, numeric / company: required / contents: required / privacy_agree: required |
| `Office\Auth\LoginRequest` | ログイン | email, password: required |
| `Office\Auth\InitRequest` | 初期設定 | name: required, max:100 / email: required, max:200, **email:rfc,dns** / password: required, max:50, PasswordRule |
| `Office\Auth\ForgotPwRequest` | PW忘れ | email: required |
| `Office\Auth\SetPwRequest` | PW設定 | password: required, max:50, PasswordRule |
| `Office\Auth\OnetimeRequest` | ワンタイム | onetime_key: required |
| `Office\News\CreateRequest` / `EditRequest` | お知らせ | title: required, max:100 / news_image_url_1〜3: nullable, max:8192 / content: required, max:1000 / status: required, in(0,1) |
| `Office\Developments\CreateRequest` / `EditRequest` | 自社開発 | category, title: required, max:100 / image: nullable, max:8192 / content: required, max:1000 / home_page_url: nullable, max:100 / status: required, in(0,1) |
| `Rules\PasswordRule` | PW | 英大小・数字・記号（`!#$%&-^@;:,.[]()+=~`）を各1以上含む8文字以上、許可外文字なし |
| `Rules\KatakanaRule` | — | 未使用 |

- エラーメッセージは日本語でRequestごとに定義（`*.required` => 必須項目です。など）。`resources/lang` は en のみ。
- `tel: numeric` はハイフン入力を弾く（プレースホルダは `03-1234-5678` と矛盾）。
- 移行先候補: Zod / Valibot / Yup をクライアント・サーバーで共用。`email:dns` 相当はサーバー側で MX 参照するか、省略するかは要判断。

### 3.6 セッション依存の画面遷移

管理画面の登録・編集は「入力 → 確認 → 実行 → 完了」の4ステップで、入力値と整形済みinsert/update配列をセッション（`createInputNews` / `insertNews` など8キー）に保存している。検索条件（`officeNewsIndexSearchParams` 等）もセッションに保持し、戻るリンクに復元している。問い合わせフォームも `withInput()` によるセッションフラッシュで入力を戻す。

移行先候補: React側の状態（マルチステップフォーム）で保持し、サーバーには最終確定時のみ送信する。検索条件はURLクエリに乗せる。これにより Serverless でのセッション依存を大幅に減らせる。

### 3.7 外部サービス連携

| サービス | 用途 | 場所 | 備考 |
|---|---|---|---|
| Google Fonts | Inter / Noto Sans JP / Noto Serif JP / Public Sans | 各ビュー `<head>` | 移行後もCDNまたは `next/font` 等でセルフホスト |
| Font Awesome Kit（`1c70550d95`） | アイコン | 全公開ビュー | アカウント紐付きKit。Kit継続かパッケージ導入かは要判断 |
| Bootstrap 5.3.0 / Bootstrap Icons 1.11.3（jsDelivr） | CSS / アイコン | 公開ビュー | React移行時にBootstrapを残すかCSS Modules等へ置換するかは要判断 |
| jQuery 3.6.0（Google CDN） | アニメーション・ナビ | 公開ビュー | React化で不要になる想定 |
| Google Maps Embed | 会社所在地 | `/aboutus` | iframe、APIキー不要 |
| Kaspersky スクリプト | — | 旧 `index.blade.php` / `layout.blade.php` | 未使用ビューのみ。開発者PCの製品が挿入したものと見られる |
| Google Geocoding API | 住所検索 | `public/backend/js/google.zip.js` | 管理レイアウトで読み込むがキー空・未使用 |
| zipcloud API | 郵便番号検索 | `public/backend/js/script.js` | 該当フォームなし、未使用 |
| 外部リンク | 採用サイト `obfall-recruit.com`、`obfall.itszai.jp`、各プロダクトサイト | トップ・実績 | 静的リンク |

サーバー側の外部API呼び出し（`Utils::curl`）は定義のみで未使用。**本番で実際に動作している外部連携はメール送信（SMTP）のみ**。

### 3.8 その他のサーバー処理

| 項目 | 内容 | 移行先候補 |
|---|---|---|
| ログ | `Log::error` によるDBエラー・例外記録。`Utils::stopLog` は未使用 | Vercel Logs、Sentry、Axiom |
| ページネーション | Laravel `paginate()`。公開は10件固定、管理は20〜300可変 | サーバー側で offset/limit、クエリはURL |
| noindex | 管理レイアウトで `robots noindex,nofollow` | `metadata` / `robots.txt` |
| 日付整形 | SQL の `DATE_FORMAT` | アプリ側（dayjs / Intl） |
| 初期データ | `AdminsTableSeeder`（test@co.jp / 固定PW） | シードスクリプト。本番の初期管理者の扱いは要確認 |

---

## 4. 静的資産

### 4.1 量

| 種別 | 場所 | 件数 | 概算容量 | 備考 |
|---|---|---|---|---|
| 画像（公開側） | `public/image/` | 37 | 約31MB | 1〜4MBのJPG/PNGが13件。現行ビューで参照されているのは13件程度、旧トップ専用が9件、未参照が十数件 |
| 画像（アップロード） | `public/uploads/` | 11 | 未確認 | DBの `newses` / `inhouse_developments` から参照 |
| 自作CSS | `resources/css/app.css` | 1 | 2,839行 | CSS変数（`--premium-*`）、レスポンシブ3段階、アニメーション定義 |
| インラインCSS | 各公開ビュー | 19本 | 各150〜200行 | ほぼ同一の `:root` 変数と `.sec` / `.value-card` 等が重複 |
| 自作JS | `public/js/main.js` | 1 | 169行 | jQuery依存部分と vanilla 部分が混在 |
| 管理側自作JS | `public/backend/js/script.js` / `product-form.js` | 2 | 269行 | 大半が未使用機能（郵便番号検索等） |
| 管理側テンプレート | `public/backend/vendor/` | 87ファイル | 約88,000行 | Sneat系テンプレート。移行対象外（読み込み対象外） |
| フォント | Google Fonts（外部） | — | — | ローカルフォントは管理側の Boxicons のみ |
| favicon | `public/image/favicon.png`、`public/favicon.ico` | 2 | — | — |

### 4.2 参照切れ・不整合

- `image/noimg-square.jpg`（お知らせのサムネイル既定画像）が `public/image/` に**存在しない**。
- `image/logo_OBFall2.png`（`og:image`）が存在しない。
- 管理ログイン画面の `/logo.png` が存在しない。
- `config('app.api_key')` は未定義（管理レイアウトが参照）。
- 画像パスが `./image/...`、`../image/...`、`asset('image/...')` と混在しており、階層URLで相対パスが破綻し得る。

### 4.3 移行方法の候補

- **画像**: `public/` 配下へ移設し、Next.js の `next/image` 等で最適化。31MBのうち未使用分を除外し、大きなJPG/PNGはWebP/AVIF化を検討。`about_us2.jpg`（1.9MB）や `security.jpg`（4MB）は表示サイズに対して過大。
- **アップロード画像**: §3.4 のオブジェクトストレージへ。
- **CSS**: `app.css` のデザイントークン（`:root` 変数）を共通スタイルに移植し、19本に重複するインラインCSSを共通コンポーネントのスタイルに統合。Bootstrap のユーティリティクラス（`row`、`col-md-*`、`d-none d-md-inline` 等）は多用されているため、Bootstrap継続か Tailwind/CSS Modules への置換かを決める必要がある。
- **JS**: jQuery のフェードイン・ハンバーガー・スムーススクロールは React の state / IntersectionObserver hook に置換。SVGアニメーションはCSS keyframes と `<animateMotion>` のためそのまま流用可能。
- **管理側テンプレート**: 移行後の管理画面は Bootstrap ベースのまま再実装するか、UIライブラリ（MUI / shadcn 等）へ置換するか要判断。同梱ライブラリ（apexcharts、datepicker、typeahead、masonry）は現行機能で使われていないため移行不要。

---

## 5. 移行順序の提案

依存関係を考慮し、共通基盤から画面へ、サーバー側処理が不要なものから必要なものへ進める。

### フェーズ0: 基盤準備
1. 新規プロジェクト雛形（`./web/`）、Vercel プロジェクト、環境変数設計
2. デザイントークン移植（`--premium-*` 変数、フォント、ブレークポイント）
3. 画像アセットの選別・移設（未使用除外、圧縮）
4. 共通レイアウト: Header（PCナビ + ハンバーガー + ドロワー）、Footer、PageHero（10 variant）
5. アニメーション基盤（fadein-scroll、char-anim、anim-fade-up、anim-line、net-node）

### フェーズ1: 静的公開ページ（サーバー処理なし）
6. 企業理念、サービス4本 + サービス一覧、実績4本、会社概要、人権方針、プライバシーポリシー（#4〜#14, #19, #20）
   - この時点で「見た目一致」の検証ができ、タスク2の対象候補にもなる

### フェーズ2: DB基盤 + 公開動的ページ
7. DB選定・スキーマ移行（admins / newses / inhouse_developments）、既存データ移行、アップロード画像移設
8. お知らせ一覧・詳細（#2, #3）
9. トップ（#1）。お知らせ最新3件のみDB依存

### フェーズ3: 問い合わせ
10. メール送信基盤（サービス選定、SPF/DKIM）
11. 問い合わせ入力・確認・送信・完了（#15〜#18）

### フェーズ4: 管理画面
12. 認証基盤（セッション、bcrypt照合、試行制限、ミドルウェア）
13. ログイン / ログアウト / 初期設定（#21〜#25, #34）
14. PW再設定（#26〜#31、メール2通）
15. 管理レイアウト（サイドメニュー、alert、pagination）
16. お知らせ一覧・詳細（#35, #36）→ 登録・編集・削除（#37〜#45、画像アップロード含む）
17. 自社開発一覧・詳細 → CRUD（#46〜#56）
18. ワンタイムキー（#32, #33）は現行で無効のため、実装要否を確認のうえ最後

### フェーズ5: 切替
19. リダイレクト設計（管理URLの整理を行う場合）、robots、OGP
20. DNS切替（ムームードメイン → Vercel）、旧環境の停止

---

## 6. 工数見積もり（ポイント）

S = 1、M = 3、L = 8。処理のみのルート（画面なし）は、対応する画面のポイントに含めるか、バックエンド再構築分に計上する。

### 6.1 公開画面

| # | 画面 | 複雑度 | pt |
|---|---|---|---|
| 1 | トップ | L | 8 |
| 2 | お知らせ一覧 | M | 3 |
| 3 | お知らせ詳細 | M | 3 |
| 4 | サービス一覧 | S | 1 |
| 5 | サービス: 自社開発 | S | 1 |
| 6 | サービス: 受託開発 | S | 1 |
| 7 | サービス: SES | S | 1 |
| 8 | サービス: 脆弱性診断 | S | 1 |
| 9 | 実績トップ | S | 1 |
| 10 | 実績: 自社開発 | S | 1 |
| 11 | 実績: 受託開発 | S | 1 |
| 12 | 実績: 脆弱性診断 | S | 1 |
| 13 | 会社概要 | S | 1 |
| 14 | 企業理念 | S | 1 |
| 15 | お問い合わせ入力 | M | 3 |
| 16 | お問い合わせ確認 | M | 3 |
| 18 | 送信完了 | S | 1 |
| 19 | プライバシーポリシー | S | 1 |
| 20 | 人権方針 | S | 1 |
| | **小計（19画面）** | | **34** |

### 6.2 管理画面

| # | 画面 | 複雑度 | pt |
|---|---|---|---|
| 21 | ログイン | M | 3 |
| 23 | 初期設定 入力 | M | 3 |
| 25 | 初期設定 完了 | S | 1 |
| 26 | PW忘れ 入力 | M | 3 |
| 28 | PW忘れ 完了 | S | 1 |
| 29 | PW設定 入力 | M | 3 |
| 31 | PW設定 完了 | S | 1 |
| 32 | ワンタイムキー入力（現行無効） | M | 3 |
| 35 | お知らせ一覧 | L | 8 |
| 36 | お知らせ詳細 | S | 1 |
| 37 | お知らせ登録 入力 | M | 3 |
| 38 | お知らせ登録 確認 | M | 3 |
| 40 | お知らせ登録 完了 | S | 1 |
| 41 | お知らせ編集 入力 | M | 3 |
| 42 | お知らせ編集 確認 | M | 3 |
| 44 | お知らせ編集 完了 | S | 1 |
| 46 | 自社開発一覧 | L | 8 |
| 47 | 自社開発詳細 | S | 1 |
| 48 | 自社開発登録 入力 | M | 3 |
| 49 | 自社開発登録 確認 | M | 3 |
| 51 | 自社開発登録 完了 | S | 1 |
| 52 | 自社開発編集 入力 | M | 3 |
| 53 | 自社開発編集 確認 | M | 3 |
| 55 | 自社開発編集 完了 | S | 1 |
| | **小計（24画面）** | | **64** |

ワンタイムキー（#32）を実装しない場合は 61pt。入力・確認・完了をReactのマルチステップフォーム1コンポーネントに統合すれば、確認・完了画面分（各系統で約4pt）は圧縮できる見込み。

### 6.3 共通フロント基盤（画面とは別）

| 項目 | 複雑度 | pt |
|---|---|---|
| ヘッダー / フッター / ハンバーガードロワー | M | 3 |
| PageHero コンポーネント（10 variant のSVG） | M | 3 |
| アニメーション基盤（スクロール、文字、SVGノード） | M | 3 |
| グローバルCSS移植 + 19本のインラインCSS統合 | L | 8 |
| 管理レイアウト（サイドメニュー / alert / pagination） | M | 3 |
| **小計** | | **20** |

### 6.4 バックエンド再構築（画面とは別）

| 項目 | 複雑度 | pt |
|---|---|---|
| DB選定・スキーマ移行・既存データ移行 | M | 3 |
| 認証基盤（セッション、bcrypt互換、試行制限・ロック、ルートガード） | L | 8 |
| PW再設定（トークン発行・検証・期限） | M | 3 |
| メール送信基盤（サービス選定、SPF/DKIM、テンプレート4通） | M | 3 |
| 画像アップロード（ストレージ、既存11件移設、パス書き換え、削除） | M | 3 |
| お知らせ API（一覧検索・詳細・登録・更新・論理削除） | M | 3 |
| 自社開発 API（同上） | M | 3 |
| 問い合わせ API（バリデーション + メール2通） | M | 3 |
| 共通バリデーション（スキーマ定義、PasswordRule 移植） | S | 1 |
| **小計** | | **30** |

### 6.5 合計

| 区分 | pt |
|---|---|
| 公開画面 | 34 |
| 管理画面 | 64 |
| 共通フロント基盤 | 20 |
| バックエンド再構築 | 30 |
| **合計** | **148** |

ヘッドレスCMS案（§3.2.3）を採用した場合、管理画面64pt と お知らせ/自社開発API 6pt、画像アップロード3pt がCMS側に置き換わり、代わりにCMS連携（M=3程度）が加わる。

---

## 7. リスク・確認事項

### 7.1 現行仕様に関する確認事項（推測で埋めていない点）

1. **本番の環境設定**: `.env` は取得していない。`SESSION_DRIVER`、`MAIL_*`（SMTPホスト）、`DB_*`、`APP_URL`、`APP_NAME` の本番値が不明。メール送信元の実際のSMTPサービスは何か。
2. **DBのデータ量**: `newses` / `inhouse_developments` / `admins` の件数と、`uploads/` 11ファイルがDBのどのレコードに紐づくか。移行手順の見積もりに影響する。
3. **ロリポップDBへの外部接続可否**: 移行用ダンプをどう取得するか（phpMyAdmin経由のエクスポート等）。
4. **管理者アカウントの引き継ぎ**: 既存のbcryptハッシュをそのまま移すか、移行時に全管理者へPW再設定を求めるか。管理者の人数。
5. **ワンタイムキー（メール二段階認証）**: 現在コメントアウトで無効。移行後に有効化する意図があるか。
6. **`RedirectIfNoUser` の動作**: ホスト名に `office` を含む場合のみ有効判定を行う実装になっている。本番ホスト名は `obfall.com` と見られるため実質無効。これは意図した挙動か（旧環境で `office.xxx` サブドメイン運用だった名残の可能性）。
7. **管理画面のURL**: `/admins/newses`、`/newses/create/input`、`/inhouse_developments` と混在している。移行時に統一してよいか（統一する場合、旧URLのリダイレクト要否）。
8. **プライバシーポリシー（/privacy-policy）**: ビューが空ファイルで白紙が表示される。問い合わせページ内に全文があるため、これを独立ページとして表示するのが正か、ルート自体を廃止するか。
9. **未公開お知らせの直URL閲覧**: 公開詳細（/newses/{id}）は `status` を見ていないため、非公開記事もIDが分かれば閲覧できる。移行時に修正してよいか。
10. **サービス一覧の未使用クエリ**: `/service` はDBから自社開発を取得するがビューは静的。移行後にDB連携を残す意図があるか（トップの自社開発セクションも同様に取得するが未表示）。
11. **旧トップ（index.blade.php）**: ルートがコメントアウトされている。完全に廃止でよいか。旧トップ専用の画像9件を移行対象外としてよいか。
12. **お知らせ画像2の削除不具合**: コントローラのキー名誤り（`delete_news_mage_url_2`）で削除が機能していないと見られる。現行の運用で問題になっていないか、移行時に正しい挙動に直してよいか。
13. **SetPwMail の送信失敗の可能性**: テンプレートが存在しない `user/signature` を include している。本番でPW再設定完了メールが実際に届いているか。届いていない場合、`\Throwable` で捕捉されPW更新自体もロールバックされている可能性がある。
14. **未使用Mail 3本（AdminCreate / AdminEstimate / DeliveryUpdate）**: 他プロジェクト（NoaChoice）からの流用と見られる。移行対象外としてよいか。
15. **問い合わせのDB保存**: `Contact` モデルとコメントアウトされた保存処理がある。移行後に問い合わせ履歴をDB保存したい要望があるか。
16. **問い合わせの宛先・差出人**: `h.katono@obfall.co.jp` がハードコード。移行後も同じか、環境変数化してよいか。
17. **Font Awesome Kit**: Kit ID `1c70550d95` のアカウントは引き続き利用可能か。パッケージ版への置換可否。
18. **参照切れ画像**: `noimg-square.jpg`（お知らせ既定サムネ）、`logo_OBFall2.png`（OGP）、管理の `/logo.png`。正しい画像を用意するか、代替でよいか。
19. **`email:rfc,dns` の扱い**: 初期設定時のメールアドレスにDNS検証がある。移行後も同等の検証を行うか。
20. **`tel: numeric`**: ハイフン付き電話番号が弾かれる仕様は意図通りか。
21. **管理一覧の公開ステータス検索**: ビューは複数選択（`status[]`）、コントローラは単一値扱い。どちらの仕様が正か。
22. **表示件数の選択肢**: `PerPage` Enum は 5/0/1/2/3/4 のキーに 10/20/50/100/200/300 のラベルを持ち、ビューはラベル値をそのまま `per_page` に送る。移行後は単純に 10〜300 の数値で扱ってよいか。
23. **フレームワーク選定**: Next.js を第一候補とする前提だが、本調査で必要と分かったサーバー機能は「DBアクセス、セッション認証、メール送信、ファイルアップロード」の4種。いずれも Next.js Route Handlers / Server Actions + 外部サービスで実現可能であり、本調査からは Next.js を妨げる要素は見つからなかった。最終決定は別途。
24. **Bootstrap の扱い**: 公開ビューは Bootstrap 5 のグリッド・ユーティリティに強く依存している。React移行後も Bootstrap を残すか、CSS Modules / Tailwind へ置換するかで CSS 移植工数が変わる。
25. **ヘッドレスCMS化の可否**: 管理画面を自作せずCMSに置き換える案を採る余地があるか。運用者の操作感の変更を受け入れられるか。

### 7.2 リスク

| リスク | 影響 | 備考 |
|---|---|---|
| Serverless でのセッション前提コードの多さ | 管理画面の4ステップフォーム、検索条件保持、試行制限がすべてセッション依存 | React側状態 + URLクエリ + DB列へ置換する設計が前提。§3.6 |
| 見た目の完全一致 | 19本の公開ビューがそれぞれ独自の `<style>` を持ち、同名クラスで微妙に異なる値を定義している | 共通化の際に差分を洗い出す作業が必要。ピクセル比較の基準（現行本番のスクリーンショット）を用意したい |
| 画像容量 | 31MBのうち大半が過大サイズ | 圧縮しないと初期表示性能が悪化する |
| メール到達性 | 差出人ドメインの認証設定が未確認 | 移行後に迷惑メール判定される可能性 |
| 既存不具合の扱い | §7.1 の 9, 12, 13 など、現行の不具合をそのまま移すか直すかの判断が必要 | 「現行と一致」を優先すると不具合も再現することになる |
| 管理URLの変更 | 外部からブックマークされている可能性 | 統一する場合はリダイレクトを用意 |
| 未使用コードの混入 | Utils / Mail / JS の未使用機能、他プロジェクト名の残存 | 移行対象から明確に除外して工数を抑える |
| ロリポップ固有設定 | `.htaccess` や PHP設定に依存した挙動があるか未確認 | 本番環境にはアクセスしないため、運用者への聞き取りが必要 |

---

## 付録: 読み込み範囲

- 自作コード 139ファイルを全文読了: routes 4、app 配下 50（Controllers 8 / Middleware 10 / Requests 11 / Mail 7 / Models 3 / Enums 2 / Libraries 1 / Providers 5 / Console 1 / Exceptions 1 / Kernel 1）、database 10、Blade 60、CSS 1、JS 14。
- 設定・環境ファイル 13を部分参照: config 6本（auth / mail / database / session / filesystems / app の該当箇所のみ）、`.env.example`、`webpack.mix.js`、`docker-compose.yml`、`README.md`、`mix-manifest.json`、`package.json`、`composer.json`（依存のみ）。
- 読んでいないもの: `vendor/`・`node_modules/`（存在せず）、`public/backend/vendor/`、`public/js/app.css`・`public/css/app.css`（ビルド生成物）、`public/image/`・`public/uploads/` の中身、`tests/`（grep のみ）、`resources/lang/`（行数のみ）、`bootstrap/`、`public/index.php`、`server.php`。
