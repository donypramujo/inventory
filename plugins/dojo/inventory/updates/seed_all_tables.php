<?php

namespace Dojo\Inventory\Updates;

use Backend\Models\UserGroup;
use Illuminate\Database\Seeder;

class SeedAllTables extends Seeder {
	public function run() {
		$user_group = UserGroup::where ( 'code', 'dojo_inventory_user' )->first ();
		
		if ($user_group == null) {
			
			UserGroup::create ( [ 
					'name' => 'User',
					'code' => 'dojo_inventory_user',
					'description' => 'Manage stock per location',
					'is_new_user_default' => 0 
			] );
		}
	}
}
