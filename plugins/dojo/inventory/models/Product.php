<?php namespace Dojo\Inventory\Models;

use Model;
use Backend\Facades\BackendAuth;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
//     use \October\Rain\Database\Traits\SoftDelete;
    
    use \October\Rain\Database\Traits\Revisionable;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    		'code' => 'required|unique:dojo_inventory_products,code,NULL,id,deleted_at,NULL|max:10',
    		'name' => 'required|unique:dojo_inventory_products,name,NULL,id,deleted_at,NULL|max:50',
    		'brand_id' => 'required',
    		'category_id' => 'required',
    ];
    public $attributeNames = [ ];
    

    
    /**
     * @var array Monitor these attributes for changes.
     */
    protected $revisionable = ['code','name','deleted_at','brand_id','category_id'];
    
    /**
     * @var array Relations
     */
    public $morphMany = [
    		'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_products';
    
    public $belongsTo = [
    		'brand' => [
    				'Dojo\Inventory\Models\Brand'
    		],
    		'category' => [
    				'Dojo\Inventory\Models\Category'
    		],
    ];
    
    public function getRevisionableUser()
    {
    	return BackendAuth::getUser();
    }
    
    public function beforeValidate() {
    	$this->attributeNames = [
    			'code' => trans ( 'dojo.inventory::lang.product.code' ),
    			'name' => trans ( 'dojo.inventory::lang.product.name' ),
    			'brand_id' => trans ( 'dojo.inventory::lang.brand.brand' ),
    			'category_id' => trans ( 'dojo.inventory::lang.category.category' ),
    	];
    }
}