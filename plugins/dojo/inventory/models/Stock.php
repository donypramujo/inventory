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
    		'item_code' => 'required|unique:dojo_inventory_stocks,item_code,NULL,id,deleted_at,NULL|max:50',
    		'serial_number' => 'required|max:100',
    		'status' => 'required',
    		'product_id' => 'required',
    		'location_id' => 'required',
    		
    ];
    public $attributeNames = [ ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'dojo_inventory_stocks';
    
    
    /**
     * @var array Monitor these attributes for changes.
     */
    protected $revisionable = ['item_code','serial_number','description','status','product_id','location_id','deleted_at'];
    
    public $revisionableLimit = 1000;
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
    		'createdBy' => [
    				'Backend\Models\User','key'=>'created_by'
    		],
    		'updatedBy' => [
    				'Backend\Models\User','key'=>'updated_by'
    		]
    ];
    
    public function getRevisionableUser()
    {
    	return BackendAuth::getUser();
    }
    
    public function beforeValidate() {
    	$this->attributeNames = [
    			'item_code' => trans ( 'dojo.inventory::lang.stock.item_code' ),
    			'serial_number' => trans ( 'dojo.inventory::lang.stock.serial_number' ),
    			'status' => trans ( 'dojo.inventory::lang.stock.status' ),
    			'product_id' => trans ( 'dojo.inventory::lang.product.product' ),
    			'location_id' => trans ( 'dojo.inventory::lang.location.location' ),
    	];
    	
    	$flag = BackendAuth::getUser()->hasPermission('dojo.inventory.access_stocks_per_location');
    	if($flag) {
    		$this->location()->associate(BackendAuth::getUser()->location);
    	}
    }
    
    public function getStatusOptions($value, $formData)
    {
    	return ['unused'=>trans ( 'dojo.inventory::lang.status.unused' ),
    			'used' => trans ( 'dojo.inventory::lang.status.used' ),
    			'broken'=>trans ( 'dojo.inventory::lang.status.broken' )];
    }
    
    public function getStatuses()
    {
    	return ['unused'=>trans ( 'dojo.inventory::lang.status.unused' ),
    			'used' => trans ( 'dojo.inventory::lang.status.used' ),
    			'broken'=>trans ( 'dojo.inventory::lang.status.broken' )];
    }
    
    public function beforeCreate(){
    	$this->createdBy()->associate(BackendAuth::getUser());
    
    }
    
    public function beforeUpdate(){
    	if($this->isDirty()){
    		$this->updatedBy()->associate(BackendAuth::getUser());
    	}
    }
    
    
    public function afterCreate(){
    	
    	$history = new History();
    	
    	$history->new_status = $this->status;
    	$history->type = 'create';
    	$history->stock_id = $this->id;
    	$history->user_id = BackendAuth::getUser()->id;
    	
    	$history->save();
    }
    
    public function afterUpdate(){
    	
    	
    	if($this->isDirty('status')){
    		
    		$new_status = $this->getDirty()['status'];
    		$old_status = array_get($this->original, 'status');
    		
    		
    		$history = new History();
    		
    		$history->old_status = $old_status;
    		$history->new_status = $new_status;
    		$history->type = 'update';
    		$history->stock_id = $this->id;
    		$history->user_id = BackendAuth::getUser()->id;
    		
    		$history->save();
    		
    	}
    	
    	
    	
    }
    
    public function beforeDelete(){
    	
    	$history = new History();
    	
    	$history->old_status = $this->status;
    	$history->type = 'delete';
    	$history->stock_id = $this->id;
    	$history->user_id = BackendAuth::getUser()->id;
    	
    	$history->save();
    }
    
    public function filterFields($fields, $context = null)
    {
    	if ($context == 'update') {
    		$fields->item_code->readOnly = true;
    	}
    	
    	$flag = BackendAuth::getUser()->hasPermission('dojo.inventory.access_stocks_per_location');
    	if($flag){
    		$fields->location->hidden = true;
    	}
    }
}