<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyFieldInInShoppingCarts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('in_shopping_carts', function (Blueprint $table) {
            $table->integer('qty')->unsigned()->after('shopping_cart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('in_shopping_carts', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
    }
}
