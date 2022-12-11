@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($addstocks) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Barang Masuk</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Tanggal Masuk</label>
                                <input id="idate" type="date" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input id="iqty" type="number" name="qty" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="purchase_price">Harga Pembelian</label>
                                <input id="ipurchase_price" type="number" name="purchase_price" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select id="isupplier_id" name="supplier_id" class="form-control">
                                    <option value="">-- Choose Supplier --</option>
                                    @foreach ($suppliers as $key => $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select id="iproduct_id" name="product_id" class="form-control">
                                    <option value="">-- Choose Product --</option>
                                    @foreach ($products as $key => $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button onclick="addstock()" type="submit" class="btn btn-primary btn-default">Tambah </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    <table class="table nowarp table-bordered table-striped " style="width:100%">
                        <thead>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Quantity</th>
                            <th>Harga Pembelian</th>
                            <th>Supplier</th>
                            <th>Product</th>
                        </thead>
                        <tbody id="table_addstock">
                        </tbody>
                    </table>
                    <div class="form-footer">
                        <button onclick="submit()" type="submit" class="btn btn-primary btn-default">Simpan data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_footer')
<script>
    const dataStock = []

    function addstock() {
        const date = $('#idate').val();
        const qty = $('#iqty').val();
        const purchase_price = $('#ipurchase_price').val();
        const supplier_id = $('#isupplier_id').val();
        const product_id = $('#iproduct_id').val();
        const supplier_name = $("#isupplier_id option:selected").text();
        const product_name = $("#iproduct_id option:selected").text();
        if (
            !date || !qty || !purchase_price || !supplier_id || !product_id
        ) {
            alert('Please fill all fields!')
        } else {
            dataStock.push({
                date,
                qty,
                purchase_price,
                supplier_id,
                product_id,
                supplier_name,
                product_name,
            })

            $('#idate').val("")
            $('#iqty').val("")
            $('#ipurchase_price').val("")
            $('#isupplier_id').val("")
            $('#iproduct_id').val("")
        }

        let html = '';
        let i = 1;
        for (const key of dataStock) {
            html = html + `<tr><td>${i}</td><td>${key.date}</td><td>${key.qty}</td><td>Rp. ${key.purchase_price}</td><td>${key.supplier_name}</td><td>${key.product_name}</td></tr>`
            i++;
        }

        $('#table_addstock').html(html)
    }

    function submit() {
        if (
            dataStock.length  == 0
        ) {
            alert('Please add stock first!')
        } else {
            $.ajax({
                url: "{{ url('admin/addstocks')}}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    dataStock
                },
                type: 'json',
                success: function(data) {
                    window.location.href = "{{ url('admin/addstocks')}}";
                }
            });
        }
    }
</script>
@endsection