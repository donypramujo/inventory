<?php


namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Categories extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\FormController' 
	];
	public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_categories',
			'dojo.inventory.access_view_categories' 
	];
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'master-data', 'category' );
	}
	
	public function listExtendColumns($host) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_categories' )) {
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_categories' )) {
			$host->showCheckboxes = false;
			$host->recordUrl = 'dojo/inventory/categories/preview/:id';
		}
	}
	public function update($recordId, $context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_categories' )) {
			return $this->asExtension ( 'FormController' )->update ( $recordId, $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_categories' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
	public function create($context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_categories' )) {
			return $this->asExtension ( 'FormController' )->create ( $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_categories' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
}