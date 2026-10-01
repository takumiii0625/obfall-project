import type { Metadata } from "next";
import type { ReactNode } from "react";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";

const TITLE = "人権方針・社内相談窓口 | OBFall株式会社";
const DESCRIPTION = "当社の人権に関する基本方針と、ハラスメント等の人権侵害に関する相談・通報窓口のご案内です。";

export const metadata: Metadata = {
  title: TITLE,
  description: DESCRIPTION,
  openGraph: {
    title: TITLE,
    description: DESCRIPTION,
    type: "website",
    images: [],
  },
};

const STEPS = [
  "相談・通報の受付（メール／書面／必要に応じ対面）",
  "事実関係の確認（関係者ヒアリング、記録の確認 等）",
  "必要な是正措置（当事者の保護、職場環境の改善 等）",
  "再発防止策の策定・周知（研修、規程改定 等）",
  "相談者へのフィードバック（可能な範囲で実施）",
];

const FAQ = [
  {
    q: "匿名で相談できますか？",
    a: "可能です。匿名性を理由に受付を拒否することはありません。ただし調査の精度向上のため、可能な範囲で事実関係の特定にご協力ください。",
  },
  {
    q: "相談したことで不利益を受けることはありますか？",
    a: "ありません。当社は報復行為を固く禁じており、違反が認められた場合は懲戒等の措置を講じます。",
  },
  {
    q: "取引先や委託先からの相談は可能ですか？",
    a: "可能です。サプライチェーン全体での人権尊重の観点から、当社事業活動と関連する事項について受付します。",
  },
];

/**
 * 人権方針・相談窓口 GET /human-rights-policy（リデザイン版。design/stitch/human-rights-policy.html を参考）
 * 既存は共通ヘッダー/フッター無しの独立ページだったが、HTML に合わせて共通ヘッダー/フッター付きにする。
 * 文言は既存 (standalone)/human-rights-policy/_legacy/page.tsx のもの。
 */
export default function HumanRightsPolicyPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "人権に関する基本方針と社内相談窓口" }]} title="人権に関する基本方針と社内相談窓口" jpTitle />

        <div className="w-full bg-surface py-space-2xl">
          <div className="mx-auto flex w-full max-w-[800px] flex-col gap-space-2xl px-margin-mobile md:px-margin">
            <div className="w-full border-l-4 border-primary-container py-1 pl-space-md">
              <p className="font-serif-jp text-[20px] leading-relaxed font-bold text-on-surface lg:text-[22px]">
                すべての人の尊厳を守り、安心・安全で働きやすい職場を実現します。
              </p>
            </div>

            {/* 基本方針 */}
            <section className="flex flex-col pt-6" aria-labelledby="policy">
              <SectionHead id="policy">人権に関する基本方針</SectionHead>
              <p className="mb-10 text-base leading-loose text-on-surface">
                <strong className="font-bold text-on-surface">OBFall株式会社</strong>
                （以下「当社」）は、国連「ビジネスと人権に関する指導原則」等の国際規範および関連法令を尊重し、事業活動のあらゆる場面で人権侵害を容認しません。差別、ハラスメント、いじめ、プライバシー侵害、権利の不当な侵害など、いかなる行為に対しても未然防止と是正に努めます。
              </p>
              <div className="flex flex-col gap-8">
                <Sub title="適用範囲">
                  <p>本方針は、当社で働くすべての人（正社員、契約社員、嘱託、派遣、アルバイト等）および取引先・顧客など当社の事業活動に関わるすべての関係者に適用します。</p>
                </Sub>
                <Sub title="禁止する行為の例">
                  <ul className="flex flex-col gap-1.5">
                    <li>・人種、国籍、性別、性自認・性的指向、年齢、障がい、宗教、社会的身分等に基づく差別や不当な取扱い</li>
                    <li>・セクシュアル・パワー・モラル・マタニティ等のハラスメント</li>
                    <li>・いじめ、脅迫、名誉毀損、プライバシーや人格権の侵害</li>
                    <li>・安全配慮義務違反、過度な長時間労働の強要 等</li>
                  </ul>
                </Sub>
                <Sub title="是正・救済">
                  <p>侵害が疑われる事案を把握した場合、事実確認を行い、必要な是正措置・再発防止策を実施します。相談・通報を行った方や協力者に対する不利益取扱い（報復）を禁じます 。</p>
                </Sub>
                <Sub title="教育・周知">
                  <p>本方針の実効性を高めるため、従業員に対し継続的に教育・研修を実施し、関連規程・手順を整備します。</p>
                </Sub>
                <Sub title="見直し">
                  <p>社会情勢や法令の改正に応じ、定期的に方針を見直します。</p>
                </Sub>
              </div>
            </section>

            {/* 相談窓口 */}
            <section className="flex flex-col pt-6" aria-labelledby="contact">
              <SectionHead id="contact">人権に関する相談・通報窓口</SectionHead>
              <p className="mb-8 text-base leading-relaxed text-on-surface-variant">
                当社では、人権侵害に関する相談・通報を受け付ける窓口を設置しています。相談者のプライバシーは厳格に保護され、相談・通報を理由とするいかなる不利益取扱いも行いません。匿名での相談も可能です。
              </p>
              <dl className="mb-10 flex w-full flex-col" role="group" aria-label="相談窓口の連絡先">
                <ContactRow label="窓口名">人権・ハラスメント相談窓口</ContactRow>
                <ContactRow label="担当部署">管理部</ContactRow>
                <ContactRow label="受付時間">平日 9:00〜18:00（年末年始・当社指定休日を除く）</ContactRow>
                <ContactRow label="メール">
                  {/* 既存は href に mailto: が無い（現行の不具合として報告済み）。HTML に合わせて mailto: にする */}
                  <a href="mailto:info@obfall.co.jp" className="font-latin text-[17px] tracking-wide text-primary hover:underline">
                    info@obfall.co.jp
                  </a>
                </ContactRow>
                <ContactRow label="郵送">
                  〒105-0022 東京都港区海岸1-2-3 汐留芝離宮ビルディング 21F
                  <br />
                  OBFall株式会社 人権・ハラスメント相談窓口 行
                </ContactRow>
              </dl>

              <h3 className="mb-6 font-serif-jp text-lg font-bold text-on-surface">受付から対応までの流れ</h3>
              <ol className="mb-6 flex flex-col gap-2">
                {STEPS.map((step, i) => (
                  <li key={step} className="flex items-start gap-4 rounded-lg bg-surface-container-low/70 p-4">
                    <span className="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary font-latin font-bold text-on-primary">{i + 1}</span>
                    <p className="pt-0.5 text-base text-on-surface">{step}</p>
                  </li>
                ))}
              </ol>
              <p className="text-xs text-on-surface-variant">※個人情報は、対応に必要な範囲でのみ利用し、当社の個人情報保護方針に基づき適切に管理します。</p>
            </section>

            {/* FAQ */}
            <section className="flex flex-col pt-6" aria-labelledby="faq">
              <SectionHead id="faq">よくあるご質問（FAQ）</SectionHead>
              <div className="flex flex-col divide-y divide-outline-variant/40">
                {FAQ.map((f) => (
                  <div key={f.q} className="flex flex-col gap-3 py-6">
                    <div className="flex items-start gap-3">
                      <span className="pt-0.5 font-latin text-xl leading-none font-bold text-primary-container">Q.</span>
                      <p className="text-base font-bold text-on-surface">{f.q}</p>
                    </div>
                    <div className="flex items-start gap-3">
                      <span className="pt-0.5 font-latin text-xl leading-none font-bold text-outline">A.</span>
                      <p className="text-base leading-relaxed text-on-surface-variant">{f.a}</p>
                    </div>
                  </div>
                ))}
              </div>
            </section>

            {/* 改定履歴 */}
            <section className="flex flex-col pt-6 pb-8" aria-labelledby="policy-meta">
              <SectionHead id="policy-meta" tight>
                改定履歴
              </SectionHead>
              <p className="text-sm tracking-wide text-on-surface-variant">制定：2025年10月1日／最終改定：2025年10月6日</p>
            </section>
          </div>
        </div>
      </main>
      <Footer />
    </>
  );
}

function SectionHead({ id, tight, children }: { id: string; tight?: boolean; children: ReactNode }) {
  return (
    <div className={`inline-block w-full border-b-2 border-primary-container pb-3 ${tight ? "mb-6" : "mb-8"}`}>
      <h2 id={id} className="font-serif-jp text-[22px] font-bold tracking-tight text-on-surface lg:text-[26px]">
        {children}
      </h2>
    </div>
  );
}

function Sub({ title, children }: { title: string; children: ReactNode }) {
  return (
    <div className="flex flex-col gap-2">
      <h3 className="font-serif-jp text-lg font-bold text-on-surface">{title}</h3>
      <div className="text-base leading-relaxed text-on-surface-variant">{children}</div>
    </div>
  );
}

function ContactRow({ label, children }: { label: string; children: ReactNode }) {
  return (
    <div className="flex flex-col border-b border-outline-variant/40 py-4 md:flex-row md:gap-space-lg">
      <dt className="mb-1 w-full text-base font-bold text-on-surface md:mb-0 md:w-32 md:shrink-0">{label}</dt>
      <dd className="text-base leading-relaxed text-on-surface-variant md:flex-1">{children}</dd>
    </div>
  );
}
