<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('order')->nullable();
            $table->decimal('initial_balance', 15, 4)->nullable();
            $table->boolean('enabled');
            $table->text('options')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('accounts')->insert([
            'title' => 'نقدی',
            'enabled' => true
        ]);
        DB::table('accounts')->insert([
            'title' => 'بانکی',
            'enabled' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
