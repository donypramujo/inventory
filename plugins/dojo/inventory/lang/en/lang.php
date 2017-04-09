<?php
return [ 
		'plugin' => [ 
				'name' => 'Inventory',
				'description' => '' 
		],
		'model' => [ 
				'created_at' => 'Created At',
				'updated_at' => 'Updated At',
				'deleted_at' => 'Deleted At',
				'created_by' => 'Created By',
				'updated_by' => 'Updated By',
				'export' => 'Export' 
		],
		'brand' => [ 
				'id' => 'ID',
				'name' => 'Brand Name',
				'brand' => 'Brand',
				'code' => 'Brand Code',
				'find_brand' => 'Click the %s button to find a brand' 
		],
		'menuitem' => [ 
				'master_data' => 'Master Data',
				'user' => 'User',
				'log' => 'Log',
				'report' => 'Report',
				'summary_of_stock' => 'Summary of Stock',
				'history_of_stock' => 'History of Stock' 
		],
		'permission' => [ 
				'master_data' => 'Master Data',
				'manage_brands' => 'Manage brands',
				'manage_categories' => 'Manage categories',
				'manage_product_types' => 'Manage product types',
				'manage_locations' => 'Manage locations',
				'stock' => 'Inventory - Stock',
				'manage_stocks' => 'Manage stocks',
				'manage_users' => 'Manage users',
				'manage_stocks_per_location' => 'Manage stocks per location',
				'report' => 'Inventory - Report',
				'manage_summary_of_stocks' => 'Manage summary of stocks',
				'manage_history_of_stocks' => 'Manage history of stocks',
				'view_stocks' => 'View stocks',
				'brand' => 'Inventory - Brand',
				'category' => 'Inventory - Category',
				'product_type' => 'Inventory - Product Type',
				'location' => 'Inventory - Location',
				'user' => 'Inventory - User',
				'view_brands' => 'View brands',
				'view_categories' => 'View categories',
				'view_product_types' => 'View product types',
				'view_locations' => 'View locations',
				'view_users' => 'View users' 
		],
		'category' => [ 
				'id' => 'ID',
				'category' => 'Category',
				'name' => 'Category Name',
				'code' => 'Category Code',
				'find_category' => 'Click the %s button to find a category' 
		],
		'product_type' => [ 
				'product_type' => 'Product Type',
				'id' => 'ID',
				'code' => 'Product Type Code',
				'name' => 'Product Type Name',
				'find_product_type' => 'Click the %s button to find a product type' 
		],
		'location' => [ 
				'location' => 'Location',
				'id' => 'ID',
				'code' => 'Location Code',
				'name' => 'Location Name',
				'find_location' => 'Click the %s button to find a location' 
		],
		'stock' => [ 
				'stock' => 'Stock',
				'serial_number' => 'Serial Number',
				'description' => 'Description',
				'photo' => 'Photo',
				'status' => 'Status',
				'item_code' => 'Item Code',
				'count' => 'Count',
				'export' => 'Export',
				'summary_of_stocks' => 'Summary of Stocks',
				'export_summary_of_stocks' => 'Export Summary of Stocks' 
		],
		'status' => [ 
				'unused' => 'Unused',
				'used' => 'Used',
				'broken' => 'Broken' 
		],
		'history' => [ 
				'new_status' => 'New Status',
				'old_status' => 'Old Status',
				'type' => 'Type' 
		] 
];