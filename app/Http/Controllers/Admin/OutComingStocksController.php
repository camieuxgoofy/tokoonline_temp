<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStocksRequest;
use Str;
use Auth;
use DB;
use Session;
use App\Authorizable;
use App\Imports\OrderImport;
use App\Models\AddStock;
use App\Models\DetailAddStock;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OutComingStock;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;

class OutComingStocksController extends Controller
{
	use Authorizable;
	public function __construct()
	{
		parent::__construct();

		$this->data['currentAdminMenu'] = 'stock';
		$this->data['currentAdminSubMenu'] = 'outcoming_stock';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['outcomingstocks'] = OutComingStock::with('user')->orderBy('created_at', 'DESC')->paginate(10);
		return view('admin.outcomingstock.index', $this->data);
	}

	// public function show($id)
	// {
	// 	$this->data['data'] = DetailAddStock::with('product')->where('add_stock_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
	// 	return view('admin.addstock.detail', $this->data);
	// }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.outcomingstock.form', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store()
	{
		$collection = Excel::toArray(new OrderImport, request()->file('file'));
		$params = request()->except('_token');
		$insert = DB::transaction(
			function () use ($params, $collection) {
				$payloadOut = [
					"id" => Str::uuid(),
					"category" => $params['kategori'],
					"file_name" => request()->file('file')->getClientOriginalName(),
					"total_row" => count($collection[0]),
					"user_id" => \Auth::user()->id
				];

				OutComingStock::create($payloadOut);

				foreach ($collection[0] as $key => $value) {

					$checkOrder = Order::where('code', $value['no_pesanan'])->first();
					if (!$checkOrder){
						$payload = [
							"user_id" => \Auth::user()->id,
							"code" => $value["no_pesanan"],
							"status" => "completed",
							"order_date" => $value["waktu_pesanan_dibuat"],
							"payment_status" => "paid",
							"base_total_price" => str_replace(".", "", $value["harga_awal"]),
							"discount_amount" => str_replace(".", "", $value["total_diskon"]),
							"shipping_cost" => str_replace(".", "", $value["perkiraan_ongkos_kirim"]),
							"grand_total" => str_replace(".", "", $value["total_pembayaran"]),
							"shipping_service_name" => $value["opsi_pengiriman"],
							"note" => "Order From ". $params['kategori'],
							"out_coming_stock_id" => $payloadOut['id']
						];

						$order = Order::create($payload);
					}

					$product = Product::where('sku', $value['sku_induk'])->first();
					
					$checkOrderItem = null;

					if ($checkOrder){
						$checkOrderItem = OrderItem::where([['product_id', $product->id], ['order_id', $checkOrder->id]])->first();
					}

					if (!$checkOrderItem){
						$payloadItem = [
							"order_id" => $order->id,
							"product_id" => $product->id,
							"qty" => $value['jumlah'],
							"sku" => $value["sku_induk"],
							"name" => $value["nama_produk"],
							"attributes" => "[]"
						];

						OrderItem::create($payloadItem);

						$productInventory = ProductInventory::where('product_id', $product['id'])->firstOrFail();
						$newQty = (int)$productInventory['qty'] - (int)$value['jumlah'];

						$productInventory->update(["qty" => $newQty]);
					}
				}

				return "success";
			}
		);

		if ($insert) {
			Session::flash('success', 'Stock has been saved');
		} else {
			Session::flash('error', 'Stock could not be saved');
		}

		return redirect('admin/outcomingstocks/');
	}
}
