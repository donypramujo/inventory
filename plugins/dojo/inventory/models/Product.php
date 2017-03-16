<?php namespace Dojo\Inventory\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_products';
    
    public $belongsTo = [
    		'brand' => [
    				'Dojo\Inventory\Models\Brand'
    		]
    ];
}