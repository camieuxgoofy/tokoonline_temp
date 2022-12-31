<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$total_products = Product::count();
		$total_orders = Order::count();
		$total_users = User::count();
		$qty_min_count = DB::table('product_inventories')
			->where('qty', '<', 10)
			->count();
		$qty_min_index = DB::table('product_inventories')
			->where('qty', '<', 10)
			->join('products', 'products.id', '=', 'product_inventories.product_id')
			->leftjoin('suppliers', 'suppliers.id', '=', 'products.supplier_id')
			->select('suppliers.name as supplier_name', 'products.name as product_name', 'products.price as product_price', 'product_inventories.qty as product_qty', 'suppliers.wa_number as supp_wa')
			->get();

		return view('admin.dashboard.index', $this->data)
			->with(
				['total_products' => $total_products]
			)->with(
				['total_orders' => $total_orders]
			)
			->with(
				['total_users' => $total_users]
			)->with(
				['qty_min' => $qty_min_count]
			)->with(
				['qty_min_index' => $qty_min_index]
			);
	}
}
