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
        Schema::create('tbl_master_organization', function (Blueprint $table) {
            $table->id('organization_id');
            $table->string('organization_code', 20)->unique();
            $table->string('organization_name', 255);
            $table->tinyInteger('is_social_media')->nullable();
            $table->tinyInteger('is_market_place')->nullable();
            $table->tinyInteger('is_active')->default(1);
        });

        // Add your custom logic here to generate organization_code based on the rules
        DB::statement("ALTER TABLE tbl_master_organization MODIFY organization_id INTEGER AUTO_INCREMENT NOT NULL");

        // Update the existing records with the generated organization_code
        DB::table('tbl_master_organization')->update([
            'organization_code' => DB::raw("CONCAT(IF(is_social_media = 1, 'ORGS_', IF(is_market_place = 1, 'ORGM_', '')), LPAD(organization_id, 5, '0'))"),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_master_organization');
    }
};