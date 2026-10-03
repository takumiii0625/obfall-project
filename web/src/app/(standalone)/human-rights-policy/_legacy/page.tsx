import type { Metadata, Viewport } from "next";
import CurrentYear from "./CurrentYear";
import "../human-rights-policy.css";

const TITLE = "人権方針・社内相談窓口 | OBFall株式会社";
const DESCRIPTION = "当社の人権に関する基本方針と、ハラスメント等の人権侵害に関する相談・通報窓口のご案内です。";

export const metadata: Metadata = {
  title: TITLE,
  description: DESCRIPTION,
  openGraph: {
    title: TITLE,
    description: DESCRIPTION,
    type: "website",
    // ルートレイアウトの og:image は継承しない（現行の本ページに og:image は無い）
    images: [],
  },
};

/** 現行の <meta name="color-scheme" content="light dark"> */
export const viewport: Viewport = {
  colorScheme: "light dark",
};

/**
 * 人権方針・相談窓口 GET /human-rights-policy（§2.1 #20）
 * 現行: resources/views/human-rights-policy.blade.php（クロージャルート、サーバー処理なし）
 * 共通ヘッダー/フッターを使わない独立ページのため (standalone) ルートグループ配下に置く。
 */
export default function HumanRightsPolicyPage() {
  return (
    <>
      <header role="banner">
        <div className="container">
          <h1>人権に関する基本方針と社内相談窓口</h1>
          <p>すべての人の尊厳を守り、安心・安全で働きやすい職場を実現します。</p>
        </div>
      </header>

      <main role="main">
        <div className="grid">
          <section aria-labelledby="policy">
            <h2 id="policy">人権に関する基本方針</h2>
            <p>
              <strong>OBFall株式会社</strong>
              （以下「当社」）は、国連「ビジネスと人権に関する指導原則」等の国際規範および関連法令を尊重し、事業活動のあらゆる場面で人権侵害を容認しません。差別、ハラスメント、いじめ、プライバシー侵害、権利の不当な侵害など、いかなる行為に対しても未然防止と是正に努めます。
            </p>

            <h3>適用範囲</h3>
            <p>本方針は、当社で働くすべての人（正社員、契約社員、嘱託、派遣、アルバイト等）および取引先・顧客など当社の事業活動に関わるすべての関係者に適用します。</p>

            <h3>禁止する行為の例</h3>
            <ul>
              <li>人種、国籍、性別、性自認・性的指向、年齢、障がい、宗教、社会的身分等に基づく差別や不当な取扱い</li>
              <li>セクシュアル・パワー・モラル・マタニティ等のハラスメント</li>
              <li>いじめ、脅迫、名誉毀損、プライバシーや人格権の侵害</li>
              <li>安全配慮義務違反、過度な長時間労働の強要 等</li>
            </ul>

            <h3>是正・救済</h3>
            <p>侵害が疑われる事案を把握した場合、事実確認を行い、必要な是正措置・再発防止策を実施します。相談・通報を行った方や協力者に対する不利益取扱い（報復）を禁じます 。</p>

            <h3>教育・周知</h3>
            <p>本方針の実効性を高めるため、従業員に対し継続的に教育・研修を実施し、関連規程・手順を整備します。</p>

            <h3>見直し</h3>
            <p>社会情勢や法令の改正に応じ、定期的に方針を見直します。</p>
          </section>

          <section aria-labelledby="contact">
            <h2 id="contact">人権に関する相談・通報窓口</h2>
            <p>当社では、人権侵害に関する相談・通報を受け付ける窓口を設置しています。相談者のプライバシーは厳格に保護され、相談・通報を理由とするいかなる不利益取扱いも行いません。匿名での相談も可能です。</p>

            <div className="contact-card" role="group" aria-label="相談窓口の連絡先">
              <p>
                <strong>窓口名：</strong>人権・ハラスメント相談窓口
              </p>
              <p>
                <strong>担当部署：</strong>管理部
              </p>
              <p>
                <strong>受付時間：</strong>平日 9:00〜18:00（年末年始・当社指定休日を除く）
              </p>
              <p>
                <strong>メール：</strong>
                {/* ※現行は href に mailto: が無く相対 URL になっている（不具合の可能性）。作業ルールに従い現行通り。確認事項として報告 */}
                <a href="info@obfall.co.jp">info@obfall.co.jp</a>
              </p>
              <p>
                <strong>郵送：</strong>〒105-0022 東京都港区海岸1-2-3 汐留芝離宮ビルディング 21F <br />
                OBFall株式会社 人権・ハラスメント相談窓口 行
              </p>
            </div>

            <h3>受付から対応までの流れ</h3>
            <ol>
              <li>相談・通報の受付（メール／書面／必要に応じ対面）</li>
              <li>事実関係の確認（関係者ヒアリング、記録の確認 等）</li>
              <li>必要な是正措置（当事者の保護、職場環境の改善 等）</li>
              <li>再発防止策の策定・周知（研修、規程改定 等）</li>
              <li>相談者へのフィードバック（可能な範囲で実施）</li>
            </ol>

            <p className="disclaimer">※個人情報は、対応に必要な範囲でのみ利用し、当社の個人情報保護方針に基づき適切に管理します。</p>
          </section>
        </div>

        <section aria-labelledby="faq">
          <h2 id="faq">よくあるご質問（FAQ）</h2>
          <details>
            <summary>匿名で相談できますか？</summary>
            <p>可能です。匿名性を理由に受付を拒否することはありません。ただし調査の精度向上のため、可能な範囲で事実関係の特定にご協力ください。</p>
          </details>
          <details>
            <summary>相談したことで不利益を受けることはありますか？</summary>
            <p>ありません。当社は報復行為を固く禁じており、違反が認められた場合は懲戒等の措置を講じます。</p>
          </details>
          <details>
            <summary>取引先や委託先からの相談は可能ですか？</summary>
            <p>可能です。サプライチェーン全体での人権尊重の観点から、当社事業活動と関連する事項について受付します。</p>
          </details>
        </section>

        <section aria-labelledby="policy-meta">
          <h2 id="policy-meta">改定履歴</h2>
          <p>制定：2025年10月1日／最終改定：2025年10月6日</p>
        </section>
      </main>

      <footer role="contentinfo">
        <p>
          © <CurrentYear /> OBFall株式会社 / このページは一般公開用の情報提供を目的としています。
        </p>
      </footer>
    </>
  );
}
