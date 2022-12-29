<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStocksRequest;
use Str;
use Auth;
use DB;
use Session;
use App\Authorizable;
use App\Http\Requests\OutComingStocksRequest;
use App\Imports\OrderImport;
use App\Models\AddStock;
use App\Models\DetailAddStock;
use App\Models\DetailOutComingStock;
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

	public function show($id)
	{
		$this->data['data'] = OrderItem::whereHas('order', function ($q) use ($id) {
			$q->where('out_coming_stock_id', $id);
		})->orderBy('created_at', 'DESC')->paginate(10);
		return view('admin.outcomingstock.detail', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$products = Product::orderBy('name', 'ASC')->get();
		$this->data['products'] = $products;
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
				$code = [];
				foreach ($collection[0] as $key => $value) {
					$checkOrder = Order::where('code', $value['no_pesanan'])->first();
					$base_price = (int)str_replace(".", "", $value["harga_awal"]);
					$base_total = $base_price * (int)$value['jumlah'];
					$discount_amount = (int)str_replace(".", "", $value["total_diskon"]);
					$sub_total = $base_total - $discount_amount;
					if (!in_array($value["no_pesanan"], $code)) {
						array_push($code, $value["no_pesanan"]);
					}

					if (!$checkOrder) {
						$payload = [
							"user_id" => \Auth::user()->id,
							"code" => $value["no_pesanan"],
							"status" => "completed",
							"order_date" => $value["waktu_pesanan_dibuat"],
							"payment_status" => "paid",
							"base_total_price" => str_replace(".", "", $value["total_pembayaran"]),
							"shipping_cost" => str_replace(".", "", $value["perkiraan_ongkos_kirim"]),
							"grand_total" => str_replace(".", "", $value["total_pembayaran"]),
							"shipping_service_name" => $value["opsi_pengiriman"],
							"note" => "Order From " . $params['kategori'],
							"out_coming_stock_id" => $payloadOut['id'],
							"customer_first_name" => $value['username_pembeli'],
							"customer_address1" => $value['alamat_pengiriman'],
							"customer_phone" => $value['no_telepon'],
						];

						$order = Order::create($payload);
					}

					$product = Product::where('sku', $value['sku_induk'])->first();

					$checkOrderItem = null;

					if ($checkOrder) {
						$checkOrderItem = OrderItem::where([['product_id', $product->id], ['order_id', $checkOrder->id]])->first();
					}

					if (!$checkOrderItem) {
						$payloadItem = [
							"order_id" => $order->id,
							"product_id" => $product->id,
							"qty" => $value['jumlah'],
							"sku" => $value["sku_induk"],
							"name" => $value["nama_produk"],
							"weight" => str_replace(" gr", ".00", $value["berat_produk"]),
							"attributes" => "[]",
							"base_price" => $base_price,
							"base_total" => $base_total,
							"discount_amount" => $discount_amount,
							"sub_total" => $sub_total,
						];

						OrderItem::create($payloadItem);

						$productInventory = ProductInventory::where('product_id', $product['id'])->firstOrFail();
						$newQty = (int)$productInventory['qty'] - (int)$value['jumlah'];

						$productInventory->update(["qty" => $newQty]);
					}
				}

				$order = Order::whereIn('code', $code)->get();

				foreach ($order as $key => $value) {
					$shipping_cost = (int)$value->shipping_cost;
					$totalBayar = (int)$value->grand_total;
					$detailOrder = OrderItem::where('order_id', $value->id)->get();
					$total = 0;
					foreach ($detailOrder as $key => $value2) {
						$total += (int)$value2->sub_total;
					}
					$total = $total + $shipping_cost;
					$selisih = $totalBayar - $total;
					$update = [
						'base_total_price' => $totalBayar - $selisih,
						'tax_amount' => $selisih
					];

					Order::where('id', $value->id)->update($update);
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

	public function storeManual(OutComingStocksRequest $request)
	{
		$params = $request->except('_token');
		$addstocks = DB::transaction(
			function () use ($params) {
				$params['id'] = Str::uuid();
				$params['user_id'] = \Auth::user()->id;
				$params['category'] = 'manual';
				$params['total_row'] = count($params['dataStock']);
				$params['file_name'] = '';
				OutComingStock::create($params);
				$total = 0;
				foreach ($params['dataStock'] as $key => $value) {
					$value['id'] = Str::uuid();
					$value['out_coming_stock_id'] = $params['id'];
					// DetailOutComingStock::create($value);

					$productInventory = ProductInventory::where('product_id', $value['product_id'])->firstOrFail();
					$newQty = (int)$productInventory['qty'] - (int)$value['qty'];

					$productInventory->update(["qty" => $newQty]);

					$total += $value['qty']*(int)$value['price'];
				}
				
				$payload = [
					"user_id" => \Auth::user()->id,
					"code" => Order::generateCode(),
					"status" => "completed",
					"order_date" => $params['date'],
					"payment_status" => "paid",
					"base_total_price" => $total,
					"grand_total" => $total,
					"note" => "Order Created Manual",
					"out_coming_stock_id" => $params['id'],
					"customer_first_name" => $params['customer_name']
				];

				$order = Order::create($payload);

				foreach ($params['dataStock'] as $key => $value) {
					$product = Product::where('id', $value['product_id'])->firstOrFail();
					$payloadItem = [
						"order_id" => $order->id,
						"product_id" => $value['product_id'],
						"qty" => $value['qty'],
						"sku" => $product->sku,
						"name" => $product->name,
						"weight" => $product->weight,
						"attributes" => "[]",
						"base_price" => $value['price'],
						"base_total" => $value['price']*$value['qty'],
						"sub_total" => $value['price']*$value['qty']
					];
	
					OrderItem::create($payloadItem);
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
