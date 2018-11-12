<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMediaCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE media_files CHANGE COLUMN code code TEXT NOT NULL;");
        // Schema::table('media_files', function (Blueprint $table) {
        //     $table->text('code')->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE media_files CHANGE COLUMN code code VARCHAR(255) NOT NULL;");
        // Schema::table('media_files', function (Blueprint $table) {
        //     $table->string('code')->change();
        // });

    }
}
