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
            CREATE TABLE admins (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理者ID',
                name VARCHAR(255) COMMENT '氏名',
                email VARCHAR(255) COMMENT 'メールアドレス',
                password TEXT COMMENT 'ハッシュ化パスワード',
                onetime_key VARCHAR(255) COMMENT 'ログイン用ワンタイムキー',
                remember_token TEXT COMMENT 'パスワード設定トークン',
                login_locked_at DATETIME COMMENT 'ログインロック日時',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
                activated_at DATETIME COMMENT '有効化日時（初期パスワード設定日時）',
                updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時',
                terminated_at DATETIME COMMENT '退職日時',
                deleted_at DATETIME COMMENT '削除日時',
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理者マスター'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
