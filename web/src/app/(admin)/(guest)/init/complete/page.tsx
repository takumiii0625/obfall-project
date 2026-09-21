import type { Metadata } from "next";
import OfficeCompleteCard from "@/components/office/OfficeCompleteCard";

export const metadata: Metadata = {
  title: "管理者初期IDPW編集 | OBFall株式会社",
};

/**
 * 初期設定完了 GET /init/complete（§2.2 #25）
 * 現行: office/auth/init/complete.blade.php（セッション flush）。移行後は initAction 側でサインアウト済み。
 */
export default function OfficeInitCompletePage() {
  return <OfficeCompleteCard title="設定完了">管理者情報を設定しました。</OfficeCompleteCard>;
}
