import { handlers } from "@/auth";

/** Auth.js の標準エンドポイント（/api/auth/*）。ログイン自体は Server Action（office/login/actions.ts）経由 */
export const { GET, POST } = handlers;
