<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE TABLE newses (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'お知らせID',
                title VARCHAR(255) COMMENT 'タイトル',
                content TEXT COMMENT '内容',
                news_image_url_1 VARCHAR(255) COMMENT '商品画像URL1',
                news_image_url_2 VARCHAR(255) COMMENT '商品画像URL2',
                news_image_url_3 VARCHAR(255) COMMENT '商品画像URL3',
                status TINYINT(1) NOT NULL DEFAULT 1 COMMENT '公開ステータス 0: 非公開, 1: 公開',
                notes TEXT COMMENT '備考',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
                updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
                deleted_at DATETIME COMMENT '削除日時',
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='お知らせマスター'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newses');
    }
};
