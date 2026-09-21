import type { Metadata } from "next";
import { requireInitialAdminId } from "@/lib/office-session";
import InitForm from "./InitForm";

export const metadata: Metadata = {
  title: "管理者初期IDPW編集 | OBFall株式会社",
};

/**
 * 初期管理者の氏名・メール・PW 設定 GET /init/input（§2.2 #23）
 * 現行: office/auth/init/input.blade.php + OfficeAuthController@initInput（セッション firstAdmin 必須）
 * 移行後は needsInit 付きセッションが必須（proxy と requireInitialAdminId の二重チェック）。
 */
export default async function OfficeInitInputPage() {
  await requireInitialAdminId();
  return <InitForm />;
}
