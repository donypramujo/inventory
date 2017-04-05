<?php

namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use Illuminate\Support\Facades\Redirect;

class Pages extends Controller {
	public $implement = [ ];
	public $requiredPermissions = [ ];
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		if ($this->user->hasAccess ( [ 
				'dojo.inventory.access_users',
				'dojo.inventory.access_view_users' 
		], false )) {
			return redirect ( 'backend/dojo/inventory/users' );
		} else if ($this->user->hasAccess ( [ 
				'dojo.inventory.access_brands',
				'dojo.inventory.access_view_brands' 
		], false )) {
			return redirect ( 'backend/dojo/inventory/brands' );
		} else if ($this->user->hasAccess ( [ 
				'dojo.inventory.access_locations',
				'dojo.inventory.access_view_locations' 
		], false )) {
			return redirect ( 'backend/dojo/inventory/locations' );
		} else if ($this->user->hasAccess ( [ 
				'dojo.inventory.access_categories',
				'dojo.inventory.access_view_categories' 
		], false )) {
			return redirect ( 'backend/dojo/inventory/categories' );
		} else if ($this->user->hasAccess ( [ 
				'dojo.inventory.access_products',
				'dojo.inventory.access_view_products' 
		], false )) {
			return redirect ( 'backend/dojo/inventory/products' );
		}
	}
	public function report() {
		if ($this->user->hasAccess ( 'dojo.inventory.access_summary_of_stocks' )) {
			return redirect ( 'backend/dojo/inventory/summaryofstocks' );
		}else if($this->user->hasAccess ( 'dojo.inventory.access_history_of_stocks' )){
			return redirect ( 'backend/dojo/inventory/histories' );
		}
	}
}