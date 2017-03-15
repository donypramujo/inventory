<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Categories extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'dojo.inventory.access_categories' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dojo.Inventory', 'master-data', 'category');
    }
}