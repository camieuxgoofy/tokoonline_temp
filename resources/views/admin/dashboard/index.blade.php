@extends('admin.layout')

@section('content')

<!-- <h3>Page Dashboard</h3> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container pt-50">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Orders</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{ $total_orders }}</span></h2>
                    <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Products</h6>
                    <h2 class="text-right"><i class="fa fa-shopping-bag f-left"></i><span>{{ $total_products }}</span></h2>
                    <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total User</h6>
                    <h2 class="text-right"><i class="fa fa-user f-left"></i><span>{{ $total_users }}</span></h2>
                    <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Restock Needed</h6>
                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>{{ $qty_min }}</span></h2>
                    <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card-body">
    <h2 id="h2">Stock Under 10 (Restock Needed)</h2>
    <table class="table table-hover table-bordered" id="sampleTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>stock</th>
                <th>Supplier Name</th>
                <th>Call Supplier</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            <!-- @if (is_array($qty_min_index) || is_object($qty_min_index)) -->
            @foreach($qty_min_index as $p)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ $p->product_name }}</td>

                <td>{{ $p->product_qty }}</td>
                <td>{{ $p->supplier_name }}</td>
                <td><a class="btn btn-success text-center" href="https://api.whatsapp.com/send?phone={{ $p->supp_wa }}" role="button"><i class="fa fa-whatsapp"></i></a></td>
            </tr>
            @endforeach
            <!-- @endif -->
        </tbody>
    </table>
</div>

<style>
    body {
        margin-top: 20px;
        background: #FAFAFA;
    }

    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg, #4099ff, #73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg, #2ed8b6, #59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg, #FFB64D, #ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg, #FF5370, #ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }

    #sampleTable td, #sampleTable th {
        text-align: center;
        text-align: -webkit-center;
    }

    #h2 {
        color: #D01F1F;
        padding: 25px;
    }

</style>

@stop