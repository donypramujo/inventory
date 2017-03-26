<?php namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBackendUsers extends Migration
{
    public function up()
    {
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
            $table->dropColumn('location_id');
        });
    }
}
