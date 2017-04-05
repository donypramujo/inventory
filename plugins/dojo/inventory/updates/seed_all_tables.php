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
					'permission' => '{"dojo.inventory.access_stocks_per_location":"1","dojo.inventory.access_history_of_stocks":"1","dojo.inventory.access_summary_of_stocks":"1"}',
					'description' => 'Manage stock per location',
					'is_new_user_default' => 0 
			] );
			
		}
		
		$user_group = UserGroup::where ( 'code', 'dojo_inventory_user' )->first ();
		if ($user_group == null) {
			UserGroup::create ( [
					'name' => 'Admin',
					'code' => 'dojo_inventory_admin',
					'permission' =>'{"dojo.inventory.access_stocks":"1","dojo.inventory.access_locations":"1","dojo.inventory.access_users":"1","system.access_logs":"1","dojo.inventory.access_products":"1","dojo.inventory.access_history_of_stocks":"1","dojo.inventory.access_summary_of_stocks":"1","dojo.inventory.access_brands":"1","dojo.inventory.access_categories":"1"}',
					'description' => 'Manage inventory',
					'is_new_user_default' => 0
			] );
		}
		
		$user_group = UserGroup::where ( 'code', 'dojo_inventory_inspector' )->first ();
		if ($user_group == null) {
			UserGroup::create ( [
					'name' => 'Inspector',
					'code' => 'dojo_inventory_inspector',
					'permission' =>'{"dojo.inventory.access_view_stocks":"1","dojo.inventory.access_view_locations":"1","dojo.inventory.access_view_users":"1","dojo.inventory.access_view_products":"1","dojo.inventory.access_history_of_stocks":"1","dojo.inventory.access_summary_of_stocks":"1","dojo.inventory.access_view_brands":"1","dojo.inventory.access_view_categories":"1"}',
					'description' => 'Manage inventory',
					'is_new_user_default' => 0
			] );
		}
		
	}
}
