<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuppliersRequest;
use Str;
use Auth;
use DB;
use Session;
use App\Authorizable;
use App\Models\Supplier;

class SuppliersController extends Controller
{
	use Authorizable;
	public function __construct()
	{
		parent::__construct();

		$this->data['currentAdminMenu'] = 'supplier';
		$this->data['currentAdminSubMenu'] = 'supplier';
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['suppliers'] = Supplier::orderBy('name', 'ASC')->paginate(10);

		return view('admin.suppliers.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.suppliers.form', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(SuppliersRequest $request)
	{
		$params = $request->except('_token');

		$supplier = DB::transaction(
			function () use ($params) {
				$supplier = Supplier::create($params);

				return $supplier;
			}
		);

		if ($supplier) {
			Session::flash('success', 'Supplier has been saved');
		} else {
			Session::flash('error', 'Supplier could not be saved');
		}

		return redirect('admin/suppliers/' . $supplier->id . '/edit/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if (empty($id)) {
			return redirect('admin/suppliers/create');
		}

		$supplier = Supplier::findOrFail($id);
		$this->data['supplier'] = $supplier;

		return view('admin.suppliers.form', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(SuppliersRequest $request, $id)
	{
		$params = $request->except('_token');

		$supplier = Supplier::findOrFail($id);

		$saved = false;
		$saved = DB::transaction(
			function () use ($supplier, $params) {
				$supplier->update($params);

				return true;
			}
		);

		if ($saved) {
			Session::flash('success', 'Supplier has been saved');
		} else {
			Session::flash('error', 'Supplier could not be saved');
		}

		return redirect('admin/suppliers');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$supplier = Supplier::findOrFail($id);

		if ($supplier->delete()) {
			Session::flash('success', 'Supplier has been deleted');
		}

		return redirect('admin/suppliers');
	}
}
