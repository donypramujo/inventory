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
            $table->string('description', 255);
            $table->string('old_status', 10);
            $table->string('new_status', 10);
            $table->string('type', 10);
            
            $table->integer('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('dojo_inventory_stocks')
            ->onUpdate('restrict')->onDelete('restrict');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('backend_users')
            ->onUpdate('restrict')->onDelete('restrict');
            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dojo_inventory_histories');
    }
}
