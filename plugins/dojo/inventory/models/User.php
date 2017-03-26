<?php

namespace Dojo\Inventory\Models;

use Model;

/**
 * Model
 */
class User extends \Backend\Models\User {
	public $belongsTo = [ 
			'location' => [ 
					'Dojo\Inventory\Models\Location' 
			] 
	];
	
	public $attributeNames = [ ];
	public function beforeValidate() {
		$this->rules['location_id'] = 'required';
		$this->attributeNames = [
				'location_id' => trans ( 'dojo.inventory::lang.location.location' ),
		];
	}
	
	public function scopeOnlyUser($query)
	{
		return $query->whereHas('groups', function ($query) {
			$query->where('code','dojo_inventory_user');
		});
	}
	
}