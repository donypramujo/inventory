<?php


namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Brands extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\FormController'
	];
	public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_brands',
			'dojo.inventory.access_view_brands' 
	];
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'master-data', 'brand' );
	}
	public function listExtendColumns($host) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_brands' )) {
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_brands' )) {
			$host->showCheckboxes = false;
			$host->recordUrl = 'dojo/inventory/brands/preview/:id';
		}
	}
	public function update($recordId, $context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_brands' )) {
			return $this->asExtension ( 'FormController' )->update ( $recordId, $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_brands' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
	public function create($context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_brands' )) {
			return $this->asExtension ( 'FormController' )->create ( $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_brands' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
}