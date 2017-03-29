<?php namespace Dojo\Inventory;

use System\Classes\PluginBase;
use Backend\Models\User;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
    
    
    public function boot(){
    	
    	User::extend(function($model) {
    		$model->belongsTo['location'] = ['Dojo\Inventory\Models\Location'];
    	});
    }
}
