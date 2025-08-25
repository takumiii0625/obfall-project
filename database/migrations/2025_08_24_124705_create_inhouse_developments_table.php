<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateInhouseDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::statement("
    CREATE TABLE `inhouse_developments` (
        `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自社開発ID',
        `category` VARCHAR(255) COMMENT 'カテゴリ',
        `title` VARCHAR(255) COMMENT 'タイトル',
        `content` TEXT COMMENT '内容',
        `inhouse_developments_image_url` VARCHAR(255) COMMENT '自社開発画像URL',
        `inhouse_developments_home_page_url` VARCHAR(255) COMMENT '自社開発ホームページURL',
        `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '公開ステータス 0: 非公開, 1: 公開',
        `notes` TEXT COMMENT '備考',
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
        `deleted_at` DATETIME NULL COMMENT '削除日時',
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    COMMENT='自社開発マスター'
");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inhouse_developments');
    }
}
