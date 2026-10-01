import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";

/**
 * Google マップの URL（現行 Blade のエンコード済み文字列をそのまま使用）。
 * ※ 現行はビル名が「汐染芝離宮」（正: 汐留芝離宮）になっている。
 *   作業ルールに従い修正せず現行通り。確認事項として報告済み。
 */
const MAP_QUERY =
  "%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%B8%AF%E5%8C%BA%E6%B5%B7%E5%B2%B81-2-3%20%E6%B1%90%E6%9F%93%E8%8A%9D%E9%9B%A2%E5%AE%AE%E3%83%93%E3%83%AB%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%2021F";
const MAP_EMBED_URL = `https://www.google.com/maps?q=${MAP_QUERY}&hl=ja&z=16&output=embed`;
const MAP_DIRECTIONS_URL = `https://www.google.com/maps/dir/?api=1&destination=${MAP_QUERY}`;

/**
 * 会社概要 GET /aboutus（§2.1 #13）
 * 現行: resources/views/user/aboutuses/show.blade.php（クロージャルート、サーバー処理なし）
 * 画面固有の <style>（.sub_aboutus / .fs-7）はマークアップで未使用のため移植していない。
 */
export default function AboutUsPage() {
  return (
    <div className="page-aboutus">
      <Header />
      <PageHero title="About US" sub="私たちOBFall株式会社について" variant="structure" />

      <main className="py-5">
        <div className="about" id="company">
          <div className="wrap">
            <div className="text-center">
              <h2 className="h4 mb-3 text-container">会社情報</h2>
              <ul className="p-0">
                <li>
                  <p className="about-head">会社名</p>
                  <p className="about-data">OBFall株式会社</p>
                </li>
                <li>
                  <p className="about-head">代表取締役</p>
                  <p className="about-data">上遠野　博紀</p>
                </li>
                <li>
                  <p className="about-head">所在地</p>
                  <p className="about-data">
                    〒105-0022
                    <br />
                    東京都港区海岸1-2-3
                    <br />
                    汐留芝離宮ビルディング 21F
                  </p>

                  {/* 地図（レスポンシブ） */}
                  <div className="ratio ratio-16x9 rounded overflow-hidden">
                    <iframe
                      src={MAP_EMBED_URL}
                      loading="lazy"
                      referrerPolicy="no-referrer-when-downgrade"
                      allowFullScreen
                      title="OBFall株式会社 所在地の地図"
                    ></iframe>
                  </div>

                  {/* マップを別タブで開く／ルート検索 */}
                  <div className="mt-2">
                    <a className="btn btn-outline-primary btn-sm" target="_blank" rel="noopener" href={MAP_DIRECTIONS_URL}>
                      ルートを検索
                    </a>
                  </div>
                </li>

                <li>
                  <p className="about-head">電話番号</p>
                  <p className="about-data">
                    03-5403-5904
                    <br />
                  </p>
                </li>
                <li>
                  <p className="about-head">設立</p>
                  <p className="about-data">
                    2022年8月2日
                    <br />
                  </p>
                </li>
                <li>
                  <p className="about-head">資本金</p>
                  <p className="about-data">1,000,000円</p>
                </li>
                <li>
                  <p className="about-head">取引先銀行</p>
                  <p className="about-data">みずほ銀行</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <Breadcrumb current="会社概要" className="m-3" />
      </main>

      <Footer />
    </div>
  );
}
