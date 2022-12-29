@extends('admin.layout')

@section('custom_head')
<style>
    .shopee,
    .manual {
        display: none;
    }
</style>
@endsection


@section('content')

@php
$formTitle = !empty($outstocks) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Barang Keluar</h2>
                </div>
                <form action="{{ url('admin/outcomingstocks') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            @csrf
                            <label for="date">Kategori Upload</label>
                            <select name="kategori" onchange="getkategori(this.value)" class="form-control">
                                <option value="">-- Choose Category --</option>
                                <option value="manual">Manual</option>
                                <option value="shopee">Upload dari Shopee</option>
                            </select>
                        </div>
                        <div class="shopee">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group shopee">
                                        <label for="qty">Import Excel</label>
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-default">Upload</button>
                            </div>
                        </div>
                        <div class="manual">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Tanggal Keluar</label>
                                        <input id="idate" type="date" name="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Quantity</label>
                                        <input id="iqty" type="number" name="qty" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga Jual</label>
                                        <input id="iprice" type="number" name="price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Nama Customer</label>
                                        <input id="icustomer_name" type="text" name="customer_name" class="form-control">
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
                </form>
            </div>
        </div>
    </div>

    <div class="manual">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-body">
                        <table class="table nowarp table-bordered table-striped " style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Harga Jual</th>
                                <th>Total Harga</th>
                                <th>Action</th>
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

</div>
@endsection

@section('custom_footer')
<script>
    function getkategori(val) {
        if (val == 'manual') {
            $('.manual').css("display", "block");
            $('.shopee').css("display", "none");
        } else if (val == 'shopee') {
            console.log('aa')
            $('.manual').css("display", "none");
            $('.shopee').css("display", "block");
        }else{
            $('.manual').css("display", "none");
            $('.shopee').css("display", "none");
        }
    }

    const dataStock = []

    function addstock() {
        const qty = $('#iqty').val();
        const price = $('#iprice').val();
        const product_id = $('#iproduct_id').val();
        const product_name = $("#iproduct_id option:selected").text();
        if (
            !qty || !price || !product_id
        ) {
            alert('Please fill all fields!')
        } else {

            dataStock.push({
                qty,
                price,
                product_id,
                product_name,
            })

            $('#iqty').val("")
            $('#iprice').val("")
            $('#iproduct_id').val("")
        }

        showData();
    }

    function showData() {
        let html = '';
        let i = 1;
        for (const [x, key] of dataStock.entries()) {
            html = html + `<tr><td>${i}</td><td>${key.product_name}</td><td>${key.qty}</td><td>Rp. ${key.price}</td><td>Rp. ${Number(key.price)* Number(key.qty)}</td><td><button onclick="deleteData(${x})" class="btn btn-danger btn-sm">delete</button></td></td></tr>`
            i++;
        }

        $('#table_addstock').html(html)
    }

    function deleteData(i) {
        dataStock.splice(i, 1)
        showData()
    }

    function submit() {
        const date = $('#idate').val();
        const customer_name = $('#icustomer_name').val();

        if (dataStock.length == 0) {
            alert('Please add stock first!')
        }

        if (!date || !customer_name) {
            alert('Please fill date and customer name!')
        }

        $.ajax({
            url: "{{ url('admin/outcomingstocks/manual')}}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                date,
                customer_name,
                dataStock
            },
            type: 'json',
            success: function(data) {
                // window.location.href = "{{ url('admin/outcomingstocks')}}";
            }
        });
    }
</script>
@endsection