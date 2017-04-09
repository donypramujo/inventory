<?php namespace Dojo\Inventory\Models;

use Model;

/**
 * Model
 */
class SummaryOfStock extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    public $rules = [
    ];
    
    public $belongsTo = [
    		'product_type' => [
    				'Dojo\Inventory\Models\ProductType'
    		],
    		'location' => [
    				'Dojo\Inventory\Models\Location'
    		],
    ];
    

    public $table = 'dojo_inventory_summary_of_stocks';
    
    public function listStatuses()
    {
    	return ['unused'=>trans ( 'dojo.inventory::lang.status.unused' ),
    			'used' => trans ( 'dojo.inventory::lang.status.used' ),
    			'broken'=>trans ( 'dojo.inventory::lang.status.broken' )];
    }
    
}