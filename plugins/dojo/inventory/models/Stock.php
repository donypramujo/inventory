<?php namespace Dojo\Inventory\Models;

use Model;
use Backend\Facades\BackendAuth;

/**
 * Model
 */
class Stock extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;
    
    use \October\Rain\Database\Traits\Revisionable;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];
    public $attributeNames = [ ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_stocks';
    
    
    /**
     * @var array Monitor these attributes for changes.
     */
    protected $revisionable = ['serial_number'];
    
    /**
     * @var array Relations
     */
    public $morphMany = [
    		'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];
    
    public $attachOne = [
    		'photo' => 'System\Models\File'
    ];
    
    public $belongsTo = [
    		'product' => [
    				'Dojo\Inventory\Models\Product'
    		],
    		'location' => [
    				'Dojo\Inventory\Models\Location'
    		],
    ];
    
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
    
    public function getStatusOptions($value, $formData)
    {
    	return ['unused'=>'Unused','used' => 'Used','broken'=>'Broken'];
    }
    
//     public function afterUpdate(){
//     	logger('mantap euy');
//     }
}