<?php namespace Dojo\Inventory\Models;

use Model;

/**
 * Model
 */
class History extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_histories';
    
    public $belongsTo = [
    		'stock' => [
    				'Dojo\Inventory\Models\Stock'
    		],
    		'user' => [
    				'Backend\Models\User'
    		],
    ];
    
    public function getStatusOptions($value, $formData)
    {
    	return ['unused'=>trans ( 'dojo.inventory::lang.status.unused' ),
    			'used' => trans ( 'dojo.inventory::lang.status.used' ),
    			'broken'=>trans ( 'dojo.inventory::lang.status.broken' )];
    }
}