import { config } from "dotenv";
import { defineConfig } from "drizzle-kit";

// Next.js と同じ優先順位で .env.local → .env を読む（drizzle-kit は .env を自動では読まない）
config({ path: [".env.local", ".env"] });

export default defineConfig({
  dialect: "postgresql",
  schema: "./src/db/schema.ts",
  out: "./drizzle",
  dbCredentials: {
    url: process.env.DATABASE_URL ?? "",
  },
  // 生成 SQL の見出しに列コメントは出ない。列の意味は src/db/schema.ts の JSDoc を参照
  verbose: true,
  strict: true,
});
