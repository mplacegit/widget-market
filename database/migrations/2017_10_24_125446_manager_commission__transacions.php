<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManagerCommissionTransacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('manager_commission_transacions', function (Blueprint $table) {
		$table->increments('id');
		$table->date('day');
		$table->integer('user_id');
		$table->text('history');
		$table->float('summa', 2);
		$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('manager_commission_transacions');
    }
}
