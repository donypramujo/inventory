<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

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
    
    
    public function test(){
    	
//     	return View::make('dojo.inventory::bapuk', ['name' => 'Charlie']);
    }
  
}