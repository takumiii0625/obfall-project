import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  // 親ディレクトリ（Laravel 側）にも package-lock.json があるため、
  // Turbopack のワークスペースルートをこのディレクトリに固定する
  turbopack: {
    root: __dirname,
  },
  // サーバー情報の露出抑制（X-Powered-By: Next.js を外す）
  poweredByHeader: false,
  // セキュリティヘッダ（サイト健康診断 2026-11-19 の指摘対応。CSP は別途）
  async headers() {
    return [
      {
        source: "/(.*)",
        headers: [
          {
            key: "Strict-Transport-Security",
            value: "max-age=63072000; includeSubDomains; preload",
          },
          { key: "X-Frame-Options", value: "SAMEORIGIN" },
          { key: "X-Content-Type-Options", value: "nosniff" },
          { key: "Referrer-Policy", value: "strict-origin-when-cross-origin" },
          {
            key: "Permissions-Policy",
            value: "camera=(), microphone=(), geolocation=(), payment=()",
          },
        ],
      },
    ];
  },
  // 管理画面の画像アップロード（お知らせ 3 枚 × 8MB + 本文）を Server Action で受けるため既定 1MB から引き上げる
  experimental: {
    serverActions: {
      bodySizeLimit: "30mb",
    },
  },
};

export default nextConfig;
