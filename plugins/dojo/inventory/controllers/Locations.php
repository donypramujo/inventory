<?php


namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Locations extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\FormController' 
	];
	public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_locations',
			'dojo.inventory.access_view_locations' 
	];
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'master-data', 'location' );
	}
	public function listExtendColumns($host) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_locations' )) {
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_locations' )) {
			$host->showCheckboxes = false;
			$host->recordUrl = 'dojo/inventory/locations/preview/:id';
		}
	}
	public function update($recordId, $context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_locations' )) {
			return $this->asExtension ( 'FormController' )->update ( $recordId, $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_locations' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
	public function create($context = null) {
		if ($this->user->hasAccess ( 'dojo.inventory.access_locations' )) {
			return $this->asExtension ( 'FormController' )->create ( $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_locations' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
}