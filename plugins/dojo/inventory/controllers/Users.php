<?php namespace Dojo\Inventory\Controllers;

use Backend\Classes\Controller;
use Backend\Models\UserGroup;
use BackendMenu;

class Users extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
    		'dojo.inventory.access_users'
    ];
    public $bodyClass = 'compact-container';
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Dojo.Inventory', 'master-data', 'user');
    }
    
    /**
     * Called before the creation form is saved.
     * @param Model
     */
    public function formAfterCreate($model)
    {
    	$group = UserGroup::where('code', 'dojo_inventory_user')->first();
    	
    	if(empty($group)){
    		$group = UserGroup::create ( [
    				'name' => 'User',
    				'code' => 'dojo_inventory_user',
    				'description' => 'Manage stock per location',
    				'is_new_user_default' => 0
    		]);
    	}
    	$model->groups()->attach($group);
    }
    
    public function listExtendQuery($query)
    {
    	$query->onlyUser();
    }
    
}