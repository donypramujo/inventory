<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDojoInventoryHistories extends Migration
{
    public function up()
    {
        Schema::create('dojo_inventory_histories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('old_status', 10)->nullable();
            $table->string('new_status', 10)->nullable();
            $table->string('type', 10)->nullable();
            
            $table->integer('stock_id')->unsigned()->nullable();
            $table->foreign('stock_id')->references('id')->on('dojo_inventory_stocks');
            
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('backend_users');
            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dojo_inventory_histories');
    }
}
