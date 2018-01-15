<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefautlFieldToDireccionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direccions', function (Blueprint $table) {
            $table->boolean('default')->default(0)->after('guide_numer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direccions', function (Blueprint $table) {
            $table->dropColumn('default');
        });
    }
}
