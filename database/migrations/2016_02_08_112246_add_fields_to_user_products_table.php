<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_product', function (Blueprint $table) {
            $table->text('review')->nullable();
            /*
             * M - Moderate
             * A - Allow
             * D - Denied
             * R - Reserve (or Return)
             */
            $table->enum('status', ['M', 'A', 'D', 'R'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_product', function (Blueprint $table) {
            $table->dropColumn('review');
            $table->dropColumn('status');
        });
    }
}
