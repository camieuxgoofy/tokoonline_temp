<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStocksRequest;
use Str;
use Auth;
use DB;
use Session;
use App\Authorizable;
use App\Models\AddStock;
use App\Models\DetailAddStock;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Supplier;

class AddStocksController extends Controller
{
	use Authorizable;
	public function __construct()
	{
		parent::__construct();

		$this->data['currentAdminMenu'] = 'stock';
		$this->data['currentAdminSubMenu'] = 'add_stock';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['addstocks'] = AddStock::with('supplier', 'user')->orderBy('date', 'DESC')->paginate(10);
		return view('admin.addstock.index', $this->data);
	}

	public function show($id)
	{
		$this->data['data'] = DetailAddStock::with('product')->where('add_stock_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
		return view('admin.addstock.detail', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$suppliers = Supplier::orderBy('name', 'ASC')->get();
		$products = Product::where('type', 'simple')->orderBy('name', 'ASC')->get();

		$this->data['suppliers'] = $suppliers;
		$this->data['products'] = $products;
		return view('admin.addstock.form', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AddStocksRequest $request)
	{
		$params = $request->except('_token');
		$addstocks = DB::transaction(
			function () use ($params) {
				$params['id'] = Str::uuid();
				$params['user_id'] = \Auth::user()->id;
				AddStock::create($params);
				foreach ($params['dataStock'] as $key => $value) {
					$value['id'] = Str::uuid();
					$value['add_stock_id'] = $params['id'];
					DetailAddStock::create($value);

					$productInventory = ProductInventory::where('product_id', $value['product_id'])->firstOrFail();
					$newQty = (int)$productInventory['qty'] + (int)$value['qty'];

					$productInventory->update(["qty" => $newQty]);
				}

				return "success";
			}
		);

		if ($addstocks) {
			Session::flash('success', 'Stock has been saved');
		} else {
			Session::flash('error', 'Stock could not be saved');
		}

		return [
			"status" => $addstocks
		];
	}
}
