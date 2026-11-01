import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import LeadStatement from "@/components/redesign/LeadStatement";
import TextLink from "@/components/redesign/TextLink";
import SectionTitle from "@/components/redesign/SectionTitle";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "受託開発実績 | OBFall Inc.",
};

/**
 * 受託開発実績 GET /achievements/contract（リデザイン版。achievements/products の構成を流用）
 * 個別プロジェクト（CareerLog / NoaChoice）の実サイト紹介は 2026-09-30 の会社の意向で削除済み。
 * 2026-11-01 に「一般化した実績事例」として再掲（サービス名・ロゴ・URL は出さず、種別・機能・工程・期間・技術のみ）。
 */

type Case = {
  /** 社内の識別用（画面には出さない） */
  ref: string;
  /** 一般化した種別（カードの見出し） */
  title: string;
  /** 主な機能・特徴 */
  desc: string[];
  /** 担当工程（未支給のものは無し） */
  scope?: string;
  period: string;
  stack: string[];
};

/** 文言は 2026-11-01 の会社支給 */
const FULL_SCOPE = "要件ヒアリング、設計、実装、テスト、運用保守まで一貫して対応。";
const CASES: Case[] = [
  {
    ref: "キャリアログ",
    title: "BtoCマッチングプラットフォーム",
    desc: ["検索機能、マッチング機能、マイページ登録、メール連携、評価機能などを実装。"],
    scope: FULL_SCOPE,
    period: "1年",
    stack: ["PHP（Laravel）", "JavaScript"],
  },
  {
    ref: "NoaChoice",
    title: "ブライダル向けECサイト",
    desc: [
      "商品登録・表示・編集・削除、検索、カート、決済、チャット機能を実装。",
      "プラットフォーム化しており、複数事業者の商品販売が可能。",
    ],
    scope: FULL_SCOPE,
    period: "6ヶ月",
    stack: ["PHP（Laravel）", "JavaScript"],
  },
  {
    ref: "AsoVision",
    title: "採用管理プラットフォーム",
    desc: ["求人管理、学生管理、企業管理、メッセージ機能、イベント告知などを実装。"],
    scope: FULL_SCOPE,
    period: "5ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
  {
    ref: "YourValue",
    title: "営業支援ツール",
    desc: ["Googleカレンダー連携、議事録機能、マッチング機能、Paid連携などを実装。"],
    scope: FULL_SCOPE,
    period: "6ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
  {
    ref: "受注・請求管理システム",
    title: "受注・請求管理システム",
    desc: ["書類の電子化、承認管理、顧客管理、メール連携などを実装。"],
    period: "6ヶ月",
    stack: ["TypeScript", "React", "Node.js"],
  },
];

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
            <ul className="grid grid-cols-1 gap-space-lg md:grid-cols-2">
              {CASES.map((c, i) => (
                <li key={c.ref} className="flex">
                  <article className="flex w-full flex-col gap-space-md rounded-xl bg-surface-container-lowest p-space-lg shadow-sm lg:p-space-xl">
                    <div className="flex flex-col gap-space-xs">
                      <span className="font-latin text-sm font-semibold tracking-[0.2em] text-primary-container">CASE {String(i + 1).padStart(2, "0")}</span>
                      <h3 className="font-serif-jp text-[20px] font-bold text-on-surface lg:text-[22px]">{c.title}</h3>
                    </div>
                    <div className="space-y-1 text-sm leading-[1.85] text-on-surface-variant">
                      {c.desc.map((d) => (
                        <p key={d}>{d}</p>
                      ))}
                    </div>
                    <dl className="mt-auto grid grid-cols-[auto_1fr] gap-x-space-md gap-y-space-xs border-t border-surface-container-high pt-space-md text-sm">
                      {c.scope ? (
                        <>
                          <dt className="font-semibold whitespace-nowrap text-on-surface">担当工程</dt>
                          <dd className="text-on-surface-variant">{c.scope}</dd>
                        </>
                      ) : null}
                      <dt className="font-semibold whitespace-nowrap text-on-surface">開発期間</dt>
                      <dd className="text-on-surface-variant">{c.period}</dd>
                      <dt className="font-semibold whitespace-nowrap text-on-surface">技術スタック</dt>
                      <dd className="flex flex-wrap gap-1.5">
                        {c.stack.map((t) => (
                          <span key={t} className="rounded-full bg-surface-container px-2.5 py-0.5 font-latin text-xs text-on-surface-variant">
                            {t}
                          </span>
                        ))}
                      </dd>
                    </dl>
                  </article>
                </li>
              ))}
              {/* 6 枚目: その他の実績（2 列の空きを埋める） */}
              <li className="flex">
                <div className="flex w-full flex-col items-start justify-center gap-space-md rounded-xl border border-dashed border-outline-variant p-space-lg lg:p-space-xl">
                  <p className="font-serif-jp text-[18px] font-bold text-on-surface">その他、複数実績ございます。</p>
                  <p className="text-sm leading-relaxed text-on-surface-variant">詳しい事例やご相談は、お気軽にお問い合わせください。</p>
                  <CardLink href="/contact" newTab>
                    お問い合わせはこちら
                  </CardLink>
                </div>
              </li>
            </ul>
          </div>
        </section>

        {/* 関連ページへのリンク（文言は既存ページのもの: トップの「サービス詳細画面へ」「実績・事例紹介」） */}
        <section className="w-full border-t border-surface-container-high bg-surface-container-lowest py-space-2xl">
          <div className="wrap flex flex-col items-start gap-space-lg sm:flex-row sm:gap-space-2xl">
            <TextLink href="/service/contract">サービス詳細画面へ</TextLink>
            <TextLink href="/achievements" tone="secondary">
              実績・事例紹介
            </TextLink>
          </div>
        </section>

        <Breadcrumb items={[{ label: "実績・事例紹介", href: "/achievements" }, { label: "受託開発" }]} />
      </main>
      <Footer />
    </>
  );
}
