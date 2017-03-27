<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Dojo\Inventory\Models\History;

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
    
   
    
//     public function formBeforeSave($model)
//     {
//     }
    
//     public function formAfterSave($model)
//     {
    	
//     }
    
//     public function update($recordId, $context = null)
//     {

//     	$history= new History();
    	
//     	$history->description  = 'test';
//     	$history->save();
   			 	
//     	return $this->asExtension('FormController')->update($recordId, $context);
//     }
    
    
    
}