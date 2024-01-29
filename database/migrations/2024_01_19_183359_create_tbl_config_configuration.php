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
        Schema::create('tbl_config_configuration', function (Blueprint $table) {
            $table->id('id');
            $table->string('configuration_id')->unique();
            $table->integer('organization_id');
            $table->string('key', 255);
            $table->string('value', 255);
            $table->tinyInteger('is_active')->default(1);
            $table->dateTime('created_on')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('modified_on')->nullable();
            $table->integer('modified_by')->nullable();
            $table->tinyInteger('is_deleted')->default(0);
            $table->dateTime('deleted_on')->nullable();
            $table->integer('deleted_by')->nullable();
        });

        DB::statement("ALTER TABLE tbl_config_configuration MODIFY id INTEGER AUTO_INCREMENT NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_config_configuration');
    }
};