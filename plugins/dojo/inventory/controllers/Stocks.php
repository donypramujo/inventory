<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend\Facades\Backend;

class Stocks extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'dojo.inventory.access_stocks' 
    ];

    public $bodyClass = 'compact-container';
    
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dojo.Inventory', 'stock');
    }
    
    public function listOverrideColumnValue($record, $columnName, $definition = null)
    {
    	
    	if($columnName == 'status'){
    		
    		if($record->status == 'unused'){
    			return '<span class="list-badge badge-info">
                        <i class="icon-info"></i>
                    </span>'.$record->getStatuses()[$record->status];
    		}

    		if($record->status == 'used'){
    			return '<span class="list-badge badge-success">
                        <i class="icon-check"></i>
                    </span>'.$record->getStatuses()[$record->status];
    		}
    		

    		if($record->status == 'broken'){
    			return '<span class="list-badge badge-danger">
                        <i class="icon-times"></i>
                    </span>'.$record->getStatuses()[$record->status];
    		}

    		return $record->getStatuses()[$record->status];
    	}
    	
    }
    
    public function listExtendQuery($query)
    {
    	
    	$flag = $this->user->hasPermission('dojo.inventory.access_stocks_per_location');
    	
    	if($flag){
    		
    		return $query->whereHas('location', function ($query) {
    			$query->where('id', $this->user->location_id );
    		});
    	}
    	
    	return $query;
    	
    	logger($b?" isinya bro":'berak');
    }
  
}