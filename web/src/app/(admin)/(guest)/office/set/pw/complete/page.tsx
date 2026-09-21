import type { Metadata } from "next";
import OfficeCompleteCard from "@/components/office/OfficeCompleteCard";

export const metadata: Metadata = {
  title: "パスワード設定 | OBFall株式会社",
};

/**
 * PW 設定完了 GET /office/set/pw/complete（§2.2 #31）
 * 現行: office/auth/set/pw/complete.blade.php（セッション flush。移行後は保持するセッションが無い）
 */
export default function OfficeSetPwCompletePage() {
  return <OfficeCompleteCard title="設定完了">パスワードを設定しました。</OfficeCompleteCard>;
}
