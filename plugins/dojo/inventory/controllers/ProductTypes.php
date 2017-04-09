<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ProductTypes extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'dojo.inventory.access_product_types',
    	'dojo.inventory.access_view_product_types'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dojo.Inventory', 'master-data', 'product-type');
    }
    
    
//     public function listExtendQuery($query)
//     {
//     	$query->with(['brand' => function ($query) {
//         	$query->withTrashed();
//     	},'category' => function ($query) {
//         	$query->withTrashed();
//     	}]);
//     }

    public function listExtendColumns($host) {
    	if ($this->user->hasAccess ( 'dojo.inventory.access_product_types' )) {
    	} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_product_types' )) {
    		$host->showCheckboxes = false;
    		$host->recordUrl = 'dojo/inventory/producttypes/preview/:id';
    	}
    }
    public function update($recordId, $context = null) {
    	if ($this->user->hasAccess ( 'dojo.inventory.access_product_types' )) {
    		return $this->asExtension ( 'FormController' )->update ( $recordId, $context );
    	} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_product_types' )) {
    		return response ( view ( 'cms::404' ), '404' );
    	}
    }
    public function create($context = null) {
    	if ($this->user->hasAccess ( 'dojo.inventory.access_product_types' )) {
    		return $this->asExtension ( 'FormController' )->create ( $context );
    	} else if ($this->user->hasAccess ( 'dojo.inventory.access_view_product_types' )) {
    		return response ( view ( 'cms::404' ), '404' );
    	}
    }
}