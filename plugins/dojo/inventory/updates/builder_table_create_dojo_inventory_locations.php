<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateDojoInventoryLocations extends Migration
{
    public function up()
    {
        Schema::create('dojo_inventory_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 10);
            $table->string('name', 50);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('backend_users', function($table)
        {
        	$table->integer('location_id')->unsigned()->nullable();;
        	$table->foreign('location_id')->references('id')->on('dojo_inventory_locations')
        	->onUpdate('restrict')->onDelete('restrict');
        
        });
    }
    
    public function down()
    {
    	Schema::table('backend_users', function($table)
    	{
    		$table->dropForeign('backend_users_location_id_foreign');
    		$table->dropColumn('location_id');
    	});
    	Schema::dropIfExists('dojo_inventory_locations');
    }
}
