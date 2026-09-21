import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  // 親ディレクトリ（Laravel 側）にも package-lock.json があるため、
  // Turbopack のワークスペースルートをこのディレクトリに固定する
  turbopack: {
    root: __dirname,
  },
  // 管理画面の画像アップロード（お知らせ 3 枚 × 8MB + 本文）を Server Action で受けるため既定 1MB から引き上げる
  experimental: {
    serverActions: {
      bodySizeLimit: "30mb",
    },
  },
};

export default nextConfig;
