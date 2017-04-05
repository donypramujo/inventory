<?php


namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Histories extends Controller {
	public $implement = [ 
			'Backend\Behaviors\ListController',
			'Backend\Behaviors\ImportExportController' 
	];
	public $listConfig = 'config_list.yaml';
	public $importExportConfig = 'config_import_export.yaml';
	public $requiredPermissions = [ 
			'dojo.inventory.access_history_of_stocks' 
	];
	public function __construct() {
		parent::__construct ();
		BackendMenu::setContext ( 'Dojo.Inventory', 'report', 'history-of-stock' );
	}
	
	
	public function listOverrideColumnValue($record, $columnName, $definition = null) {
		if ($columnName == 'new_status' && !empty($record->new_status)) {
			
			if($record->new_status == 'unused'){
				return '<span class="list-badge badge-info">
                        <i class="icon-info"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->new_status );
			}
			
			if($record->new_status == 'used'){
				return '<span class="list-badge badge-success">
                        <i class="icon-check"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->new_status );
			}
			
			
			if($record->new_status == 'broken'){
				return '<span class="list-badge badge-danger">
                        <i class="icon-times"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->new_status );
			}
			
			return trans ( 'dojo.inventory::lang.status.' . $record->new_status );
		}
		
		if ($columnName == 'old_status' && !empty($record->old_status)) {
			if($record->old_status == 'unused'){
				return '<span class="list-badge badge-info">
                        <i class="icon-info"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->old_status );
			}
				
			if($record->old_status == 'used'){
				return '<span class="list-badge badge-success">
                        <i class="icon-check"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->old_status );
			}
				
				
			if($record->old_status == 'broken'){
				return '<span class="list-badge badge-danger">
                        <i class="icon-times"></i>
                    </span>'.trans ( 'dojo.inventory::lang.status.' . $record->old_status );
			}
				
			return trans ( 'dojo.inventory::lang.status.' . $record->old_status );
		}
	}
}