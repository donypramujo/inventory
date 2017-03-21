<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDojoInventoryStocks extends Migration
{
    public function up()
    {
        Schema::create('dojo_inventory_stocks', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('item_code', 50);
            $table->string('serial_number', 100);
            $table->string('description', 255)->nullable();
            $table->string('status', 10);
            
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('dojo_inventory_products')
            ->onUpdate('restrict')->onDelete('restrict');
            
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('dojo_inventory_locations')
            ->onUpdate('restrict')->onDelete('restrict');
            

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dojo_inventory_stocks');
    }
}
