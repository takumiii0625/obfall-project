import type { Metadata } from "next";
import OfficeCompleteCard from "@/components/office/OfficeCompleteCard";

export const metadata: Metadata = {
  title: "パスワードを忘れたら | OBFall株式会社",
};

/**
 * 送信完了 GET /office/forgot/pw/complete（§2.2 #28）
 * 現行: office/auth/forgot/pw/complete.blade.php
 */
export default function OfficeForgotPwCompletePage() {
  return (
    <OfficeCompleteCard title="設定メール送信完了">
      パスワード設定用のメールを送信しました。
      <br />
      パスワードの設定を行ってください。
    </OfficeCompleteCard>
  );
}
