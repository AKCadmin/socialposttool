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
    Schema::create('tbl_post', function (Blueprint $table) {
      $table->id('id');
      $table->string('post_id');
      $table->integer('short_url_id');
      $table->string('social_media_id');
      $table->string('post_content_text')->nullable();
      $table->tinyInteger('is_media_post')->nullable();
      $table->string('post_url');
      $table->dateTime('created_on')->nullable();
      $table->integer('created_by')->nullable();
    });

    DB::statement('ALTER TABLE tbl_post MODIFY id INTEGER AUTO_INCREMENT NOT NULL');
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tbl_post');
  }
};