@extends('layouts.dashboard')


@section('title')
    <title>Subscription</title>
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <style>

    </style>
@endsection



@section('dashboard')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Auction Show</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Auction Show</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        @can('dashboard_product_verify_info')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header">
                                Information
                            </div>
                            <div class="card-body">
                                <div><span><b>Company:</b></span> {{$verify->company->name}}</div>

                                <div><span><b>Brand: </b></span>{{$verify->brand}} </div>
                                <div><span><b>Description: </b></span>{{$verify->description}} </div>
                                <div><span><b>Model: </b></span>{{$verify->model}} </div>
                                <div><span><b>Color: </b></span>{{$verify->color}} </div>
                                <div><span><b>Size (mm): </b></span>{{$verify->size}} </div>
                                <div><span><b>Metal: </b></span>{{$verify->metal}} </div>
                                <div><span><b>Condition: </b></span>{{$verify->condition}} </div>
                                <div><span><b>More condition: </b></span>  {{$verify->more_condition}} </div>
                                <div><span><b>Year: </b></span>  {{$verify->year}} </div>
                                <div><span><b>Bezel size: </b></span>  {{$verify->bezel_size}} </div>
                                <div><span><b>Bezel type: </b></span>  {{$verify->bezel_type}}</div>
                                <div><span><b>Bezel metal: </b></span>  {{$verify->bezel_metal}}</div>
                                <div><span><b>Bracelet type: </b></span>  {{$verify->bracelet_type}}</div>
                                <div><span><b>Band: </b></span>  {{$verify->band}}</div>
                                <div><span><b>Dial type: </b></span>  {{$verify->bracelet_type}}</div>
                                <div><span><b>Price: </b></span>  ${{$verify->price}}</div>
                                <div><span><b>Quantity: </b></span>  {{$verify->quantity}}</div>
                                <div><span><b>Note: </b></span>  {{$verify->note}}</div>
                                <div><span><b>Model number: </b></span>  {{$verify->model_number}}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <form action="{{route('product.verify.verify', $verify->id)}}" method="post">
                                @csrf
                                @method('post')
                            <!-- /.card-header -->
                                <div class="card-header">
                                    Access
                                </div>
                                @can('dashboard_product_verify_access')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <lable>Add to Listing</lable>
                                            <br>
                                            <input type="checkbox" name="add_listing" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                        <div class="col-3">
                                            <lable>Access to add in products</lable>
                                            <br>
                                            <input type="checkbox" name="access" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                </div>
                                @endcan
                                <div class="card-footer">
                                    @can('dashboard_product_verify_access')
                                    <button type="submit" class="btn btn-success">Save</button>
                                    @endcan
                                    @can('dashboard_product_verify_delete')
                                    <a href="{{route('product.verify.delete', $verify->id)}}" style="float: right" class="btn btn-danger">Block</a>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        @endcan
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- Bootstrap Switch -->
    <script src="{{asset('assets/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
        // setTimeout(()=>{
            $('.bootstrap-switch-handle-on').html('Yes')
            $('.bootstrap-switch-handle-off').html('No')
        // }, 1000)
    </script>
@endsection
