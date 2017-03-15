<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDojoInventoryBrands extends Migration
{
    public function up()
    {
        Schema::create('dojo_inventory_brands', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 100);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('dojo_inventory_brands');
    }
}
