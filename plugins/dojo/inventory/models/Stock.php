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
    	return ['used' => 'Used','unused'=>'Unused','broken'=>'Broken'];
    }
    
//     public function afterUpdate(){
//     	logger('mantap euy');
//     }
}