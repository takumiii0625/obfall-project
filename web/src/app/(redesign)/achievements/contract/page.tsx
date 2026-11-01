import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "受託開発実績 | OBFall Inc.",
};

/**
 * 受託開発実績 GET /achievements/contract（リデザイン版。achievements/products の構成を流用）
 * 個別プロジェクト（CareerLog / NoaChoice）の実サイト紹介は 2026-09-30 の会社の意向で削除済み。
 * 2026-11-01 に「一般化した実績事例」として再掲（サービス名・ロゴ・URL は出さず、種別・機能・工程・期間・技術のみ）。
 * 下部の「サービス詳細画面へ」「実績・事例紹介」リンクは 2026-11-01 の指示で削除。
 */

type Case = {
  /** 社内の識別用（画面には出さない） */
  ref: string;
  /** 一般化した種別（カードの見出し） */
  title: string;
  /** 一行の要約（常に表示） */
  summary: string;
  /** 以下は「詳細を見る」で開く */
  background: string;
  development: string;
  /** 主な機能（常に表示。タグ） */
  features: string[];
  /** 担当範囲（詳細内） */
  scope: string[];
  period: string;
  stack: string[];
};

/** 文言は 2026-11-01 の会社支給（2 回目） */
const FULL_SCOPE = ["要件ヒアリング", "設計", "UI設計", "開発", "テスト", "運用保守"];
const CASES: Case[] = [
  {
    ref: "キャリアログ",
    title: "BtoCマッチングプラットフォーム",
    summary: "ユーザーと企業の出会いからマッチング後のコミュニケーションまで、一つのサービス上で完結。",
    background: "ユーザー情報の管理から相手の検索、マッチング、連絡までを一元化できるサービス基盤の構築が要件。",
    development: "ユーザー登録・プロフィール管理を起点に、条件検索、マッチング、メール通知、利用後の評価まで、一連のユーザー体験を設計・開発。",
    features: ["会員登録", "条件検索", "マッチング", "マイページ", "メール連携", "評価機能"],
    scope: FULL_SCOPE,
    period: "約1年",
    stack: ["Laravel", "JavaScript"],
  },
  {
    ref: "NoaChoice",
    title: "ブライダル向けECプラットフォーム",
    summary: "複数の事業者が商品を掲載・販売できる、ブライダル領域特化型のECプラットフォーム。",
    background: "商品販売だけでなく、複数事業者の商品管理や購入者とのコミュニケーションまで一元化できる仕組みが要件。",
    development: "商品管理・検索・カート・決済に加え、複数事業者による出品や購入者とのチャットまで、EC運営に必要な機能を一つのサービスとして構築。",
    features: ["商品管理", "商品検索", "カート", "決済", "チャット", "複数事業者による出品"],
    scope: FULL_SCOPE,
    period: "約6ヶ月",
    stack: ["Laravel", "JavaScript"],
  },
  {
    ref: "AsoVision",
    title: "採用管理プラットフォーム",
    summary: "求人・学生・企業情報からコミュニケーションまで、採用活動を一つのシステムで管理。",
    background: "求人情報や学生・企業情報、やり取りなど、採用活動に必要な情報を一元管理できるプラットフォームの開発依頼。",
    development: "求人・学生・企業の各種情報管理に加え、メッセージやイベント告知など、採用活動に必要な機能をまとめて設計・開発。",
    features: ["求人管理", "学生管理", "企業管理", "メッセージ", "イベント告知"],
    scope: FULL_SCOPE,
    period: "約5ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
  {
    ref: "YourValue",
    title: "企業マッチングSaaS",
    summary: "最適なニーズを持つ企業とのマッチングを、高品質で実現。",
    background: "審査制かつ受発注を成果とした成果報酬型を取り入れ、それぞれの企業に最適なマッチングを提供するSaaSの開発が要件。",
    development: "Googleカレンダーとの予定連携、議事録による企業管理、適切なマッチング、Paid連携など、品質の担保と情報管理をひとつのシステムとして構築しました。",
    features: ["Googleカレンダー連携", "議事録", "マッチング", "Paid連携"],
    scope: FULL_SCOPE,
    period: "約6ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
  {
    ref: "受注・請求管理システム",
    title: "受注・請求管理システム",
    summary: "受注から請求までの情報と書類をデジタル化し、業務を一元管理。",
    background: "書類・顧客情報・承認状況など、受注・請求業務に関わる情報をまとめて管理できる仕組みが要件。",
    development: "書類の電子化を中心に、承認管理・顧客管理・メール連携まで、受注から請求に関わる業務をシステム上で管理できるよう構築。",
    features: ["書類管理", "承認管理", "顧客管理", "メール連携"],
    scope: ["要件ヒアリング", "設計", "開発", "テスト"],
    period: "約4ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
];

/** タグ（主な機能・技術） */
function Chip({ children, tone = "default" }: { children: string; tone?: "default" | "latin" }) {
  return (
    <span
      className={`rounded-full bg-surface-container px-2.5 py-0.5 text-xs text-on-surface-variant ${tone === "latin" ? "font-latin tracking-wide" : ""}`}
    >
      {children}
    </span>
  );
}

/**
 * 事例カード 1 件。要点（CASE 番号・見出し・要約・主な機能・期間と技術）を常に出し、
 * 背景・課題 / 開発内容 / 担当範囲は「詳細を見る」（<details>）で開閉する。JS 不要
 */
function CaseCard({ c, num }: { c: Case; num: number }) {
  return (
    <article className="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm lg:p-space-xl">
      <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-12 lg:gap-space-xl">
        <div className="flex flex-col gap-space-sm lg:col-span-8">
          <span className="font-latin text-sm font-semibold tracking-[0.2em] text-primary-container">CASE {String(num).padStart(2, "0")}</span>
          <h3 className="font-serif-jp text-[20px] font-bold text-on-surface lg:text-[22px]">{c.title}</h3>
          <p className="text-[15px] leading-[1.85] text-on-surface">{c.summary}</p>
          <ul className="flex flex-wrap gap-1.5 pt-space-xs" aria-label="主な機能">
            {c.features.map((f) => (
              <li key={f}>
                <Chip>{f}</Chip>
              </li>
            ))}
          </ul>
        </div>
        <dl className="flex flex-col gap-space-sm border-t border-surface-container-high pt-space-md text-sm lg:col-span-4 lg:border-t-0 lg:border-l lg:pt-0 lg:pl-space-lg">
          <div className="flex flex-col gap-1">
            <dt className="font-semibold text-on-surface">開発期間</dt>
            <dd className="text-on-surface-variant">{c.period}</dd>
          </div>
          <div className="flex flex-col gap-1.5">
            <dt className="font-semibold text-on-surface">技術</dt>
            <dd className="flex flex-wrap gap-1.5">
              {c.stack.map((t) => (
                <Chip key={t} tone="latin">
                  {t}
                </Chip>
              ))}
            </dd>
          </div>
        </dl>
      </div>

      <details className="case-details group mt-space-lg border-t border-surface-container-high pt-space-md">
        <summary className="inline-flex cursor-pointer list-none items-center gap-2 font-serif-jp text-sm tracking-widest text-primary transition-colors hover:text-tertiary [&::-webkit-details-marker]:hidden">
          <span className="group-open:hidden">詳細を見る</span>
          <span className="hidden group-open:inline">閉じる</span>
          <span className="inline-block text-base leading-none transition-transform duration-300 group-open:rotate-45" aria-hidden="true">
            ＋
          </span>
        </summary>
        <dl className="case-details__body grid grid-cols-1 gap-space-lg pt-space-lg text-sm leading-[1.85] md:grid-cols-3">
          <div className="flex flex-col gap-1.5">
            <dt className="font-semibold text-primary">背景・課題</dt>
            <dd className="text-on-surface-variant">{c.background}</dd>
          </div>
          <div className="flex flex-col gap-1.5">
            <dt className="font-semibold text-primary">開発内容</dt>
            <dd className="text-on-surface-variant">{c.development}</dd>
          </div>
          <div className="flex flex-col gap-1.5">
            <dt className="font-semibold text-primary">担当範囲</dt>
            <dd className="text-on-surface-variant">{c.scope.join(" / ")}</dd>
          </div>
        </dl>
      </details>
    </article>
  );
}

export default function AchievementsContractPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero
          label="ACHIEVEMENTS"
          title="Contract Development"
        />

        <LeadStatement
          statement={
            <>
              ともにつくり、ともに前へ。
              <br />
              クライアントの想いを汲み取り、共に課題を解決するパートナーとして。
            </>
          }
          body={
            <p>
              OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。
              <br className="hidden lg:inline" />
              Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、
              <br className="hidden lg:inline" />
              企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。
              <br className="hidden lg:inline" />
              クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
            </p>
          }
        />

        {/* 実績事例（一般化） */}
        <section className="w-full bg-surface-container-low/60 py-space-2xl lg:py-space-3xl">
          <div className="wrap flex flex-col gap-space-2xl">
            <SectionTitle kicker="Case Studies" title="実績事例" />
            <ul className="flex flex-col gap-space-lg">
              {CASES.map((c, i) => (
                <li key={c.ref}>
                  <CaseCard c={c} num={i + 1} />
                </li>
              ))}
              {/* その他の実績 */}
              <li>
                <div className="flex flex-col items-start gap-space-md rounded-xl border border-dashed border-outline-variant p-space-lg sm:flex-row sm:items-center sm:justify-between lg:p-space-xl">
                  <div className="flex flex-col gap-space-xs">
                    <p className="font-serif-jp text-[18px] font-bold text-on-surface">その他、複数実績ございます。</p>
                    <p className="text-sm leading-relaxed text-on-surface-variant">詳しい事例やご相談は、お気軽にお問い合わせください。</p>
                  </div>
                  <CardLink href="/contact" newTab>
                    お問い合わせはこちら
                  </CardLink>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <Breadcrumb items={[{ label: "実績・事例紹介", href: "/achievements" }, { label: "受託開発" }]} />
      </main>
      <Footer />
    </>
  );
}
