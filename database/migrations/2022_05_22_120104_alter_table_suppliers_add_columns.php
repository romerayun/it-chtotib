<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSuppliersAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->text('address');
            $table->integer('inn');
            $table->integer('ogrnip');
            $table->integer('rs');
            $table->text('rs_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('inn');
            $table->dropColumn('ogrnip');
            $table->dropColumn('rs');
            $table->dropColumn('rs_name');
        });
    }
}
