<?php namespace Dojo\Inventory\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Brand extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;
    
    use \October\Rain\Database\Traits\Revisionable;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    	'code' => 'required|unique:dojo_inventory_brands,code,NULL,id,deleted_at,NULL|max:10',
    	'name' => 'required|unique:dojo_inventory_brands,name,NULL,id,deleted_at,NULL|max:50',
    ];
    public $attributeNames = [ ];
    
    /**
     * @var array Monitor these attributes for changes.
     */
    protected $revisionable = ['code','name','deleted_at'];
    
    /**
     * @var array Relations
     */
    public $morphMany = [
    		'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_brands';
    
    public function getRevisionableUser()
    {
    	return BackendAuth::getUser();
    }
    
    public function beforeValidate() {
    	$this->attributeNames = [
    			'code' => trans ( 'dojo.inventory::lang.brand.code' ),
    			'name' => trans ( 'dojo.inventory::lang.brand.name' ),
    	];
    }
    
 
}