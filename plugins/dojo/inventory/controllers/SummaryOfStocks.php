<?php

namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class SummaryOfStocks extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend.Behaviors.ImportExportController' 
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
			return trans ( 'dojo.inventory::lang.status.' . $record->status );
		}
	}
}