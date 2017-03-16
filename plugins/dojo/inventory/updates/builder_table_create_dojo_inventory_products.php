<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDojoInventoryProducts extends Migration
{
    public function up()
    {
        Schema::create('dojo_inventory_products', function($table)
        {
        	$table->engine = 'InnoDB';
        	$table->increments('id')->unsigned();
        	$table->string('code', 10);
        	$table->string('name', 50);
        	
        	$table->integer('brand_id')->unsigned();
        	$table->foreign('brand_id')->references('id')->on('dojo_inventory_brands')
        	->onUpdate('restrict')->onDelete('restrict');
        	
        	$table->integer('category_id')->unsigned();
        	$table->foreign('category_id')->references('id')->on('dojo_inventory_categories')
        	->onUpdate('restrict')->onDelete('restrict');
        	
        	$table->timestamp('created_at')->nullable();
        	$table->timestamp('updated_at')->nullable();
        	$table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dojo_inventory_products');
    }
}
