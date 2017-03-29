<?php

namespace Dojo\Inventory\Updates;

use Backend\Models\UserGroup;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder {
	public function run() {
		$user_group = UserGroup::where ( 'code', 'dojo_inventory_user' )->first ();
		
		if ($user_group == null) {
			
			UserGroup::create ( [ 
					'name' => 'User',
					'code' => 'dojo_inventory_user',
					'permission' => '{"dojo.inventory.access_stocks_per_location":"1","dojo.inventory.access_stocks":"1"}',
					'description' => 'Manage stock per location',
					'is_new_user_default' => 0 
			] );
			
		}
		
		$user_group = UserGroup::where ( 'code', 'dojo_inventory_user' )->first ();
		if ($user_group == null) {
			UserGroup::create ( [
					'name' => 'User',
					'code' => 'dojo_inventory_admin',
					'permission' =>'{"system.access_logs":"1","dojo.inventory.access_categories":"1","dojo.inventory.access_users":"1","dojo.inventory.access_locations":"1","dojo.inventory.access_products":"1","dojo.inventory.access_brands":"1","dojo.inventory.access_stock_log":"1","dojo.inventory.access_stocks":"1"}',
					'description' => 'Manage inventory',
					'is_new_user_default' => 0
			] );
		}
		
	}
}
