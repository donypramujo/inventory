<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Users extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
    ];
    public $bodyClass = 'compact-container';
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dojo.Inventory', 'master-data', 'user');
    }
    
//     /**
//      * Called before the creation form is saved.
//      * @param Model
//      */
//     public function formAfterCreate($model)
//     {
//     	$group = UserGroup::where('code', 'jury')->firstOrFail();
//     	$model->groups()->attach($group);
//     }
    
//     public function listExtendQuery($query)
//     {
//     	$query->juries();
//     }
    
}