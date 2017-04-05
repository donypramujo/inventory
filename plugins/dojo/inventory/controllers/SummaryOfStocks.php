<?php

namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class SummaryOfStocks extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\ImportExportController' 
	];
	public $listConfig = 'config_list.yaml';
	public $importExportConfig = 'config_import_export.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_summary_of_stocks' 
	];
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'report', 'summary-of-stock' );
	}
	public function listOverrideColumnValue($record, $columnName, $definition = null) {
		if ($columnName == 'status') {
			if($record->status == 'unused'){
				return '<span class="list-badge badge-info">
                        <i class="icon-info"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			
			if($record->status == 'used'){
				return '<span class="list-badge badge-success">
                        <i class="icon-check"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			
			
			if($record->status == 'broken'){
				return '<span class="list-badge badge-danger">
                        <i class="icon-times"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->status );
			}
			return trans ( 'dojo.inventory::lang.status.' . $record->status );
		}
	}
}