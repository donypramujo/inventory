<?php

namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend\Facades\Backend;

class Stocks extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\FormController',
			'Backend\Behaviors\ImportExportController' 
	];
	public $listConfig = 'config_list.yaml';
	public $formConfig = 'config_form.yaml';
	public $importExportConfig = 'config_import_export.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_stocks',
			'dojo.inventory.access_view_stocks',
			'dojo.inventory.access_stocks_per_location'
	];
	public $bodyClass = 'compact-container';
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'stock' );
	}
	public function listOverrideColumnValue($record, $columnName, $definition = null) {
		if ($columnName == 'status') {
			
			if ($record->status == 'unused') {
				return '<span class="list-badge badge-info">
                        <i class="icon-info"></i>
                    </span>' . trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			
			if ($record->status == 'used') {
				return '<span class="list-badge badge-success">
                        <i class="icon-check"></i>
                    </span>' . trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			
			if ($record->status == 'broken') {
				return '<span class="list-badge badge-danger">
                        <i class="icon-times"></i>
                    </span>' . trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			
			return trans ( 'dojo.inventory::lang.status.' . $record->status );
		}
	}
	
	public function listExtendQuery($query) {
		if ($this->user->hasAccess ( ['dojo.inventory.access_stocks', 'dojo.inventory.access_view_stocks' ],false)) {
			return $query;
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_stocks_per_location' )) {
			return $query->whereHas ( 'location', function ($query) {
				$query->where ( 'id', $this->user->location_id );
			} );
		}
	}
	
	
	public function listExtendColumns($host) {
		if ($this->user->hasAccess ( ['dojo.inventory.access_stocks', 'dojo.inventory.access_stocks_per_location' ],false )) {
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_stocks' )) {
			$host->showCheckboxes = false;
			$host->recordUrl = 'dojo/inventory/stocks/preview/:id';
		}
	}
	public function update($recordId, $context = null) {
		if ($this->user->hasAccess ( ['dojo.inventory.access_stocks', 'dojo.inventory.access_stocks_per_location' ],false )) {
			return $this->asExtension ( 'FormController' )->update ( $recordId, $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_stocks' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
	public function create($context = null) {
		if ($this->user->hasAccess (  ['dojo.inventory.access_stocks', 'dojo.inventory.access_stocks_per_location' ],false )) {
			return $this->asExtension ( 'FormController' )->create ( $context );
		} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_stocks' )) {
			return response ( view ( 'cms::404' ), '404' );
		}
	}
}