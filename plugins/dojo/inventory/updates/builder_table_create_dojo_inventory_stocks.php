<?php

namespace Dojo\Inventory\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Support\Facades\DB;

class BuilderTableCreateDojoInventoryStocks extends Migration {
	public function up() {
		Schema::create ( 'dojo_inventory_stocks', function ($table) {
			$table->engine = 'InnoDB';
			$table->increments ( 'id' )->unsigned ();
			$table->string ( 'item_code', 50 );
			$table->string ( 'serial_number', 100 );
			$table->string ( 'description', 255 )->nullable ();
			$table->string ( 'status', 10 );
			
			$table->integer ( 'product_type_id' )->unsigned ();
			$table->foreign ( 'product_type_id' )->references ( 'id' )->on ( 'dojo_inventory_product_types' )->onUpdate ( 'restrict' )->onDelete ( 'restrict' );
			
			$table->integer ( 'location_id' )->unsigned ();
			$table->foreign ( 'location_id' )->references ( 'id' )->on ( 'dojo_inventory_locations' )->onUpdate ( 'restrict' )->onDelete ( 'restrict' );
			
			$table->integer ( 'created_user_id' )->unsigned ()->nullable ();
			$table->foreign ( 'created_user_id' )->references ( 'id' )->on ( 'backend_users' )->onUpdate ( 'restrict' )->onDelete ( 'restrict' );
			
			$table->integer ( 'updated_user_id' )->unsigned ()->nullable ();
			$table->foreign ( 'updated_user_id' )->references ( 'id' )->on ( 'backend_users' )->onUpdate ( 'restrict' )->onDelete ( 'restrict' );
			
			$table->timestamp ( 'created_at' )->nullable ();
			$table->timestamp ( 'updated_at' )->nullable ();
			$table->timestamp ( 'deleted_at' )->nullable ();
		} );
		
		DB::statement ( 'CREATE VIEW dojo_inventory_summary_of_stocks 
							AS select 0 AS id,dojo_inventory_stocks.status 
							AS status,count(dojo_inventory_stocks.status) 
							AS status_count,dojo_inventory_stocks.product_type_id 
							AS product_type_id,dojo_inventory_stocks.location_id 
							AS location_id from dojo_inventory_stocks 
							GROUP BY dojo_inventory_stocks.product_type_id,dojo_inventory_stocks.location_id,dojo_inventory_stocks.status' );
	}
	public function down() {
		Schema::dropIfExists ( 'dojo_inventory_stocks' );
		DB::statement('DROP VIEW  IF EXISTS dojo_inventory_summary_of_stocks;');
	}
}
