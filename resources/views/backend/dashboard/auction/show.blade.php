@extends('layouts.dashboard')


@section('title')
    <title>Subscription</title>
@endsection

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
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
        @can('dashboard_auction_view')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
{{--                                $auctionProducts--}}
{{--                                {{dd($auctionProduct)}}--}}
                                <div><span><b>Company:</b></span> {{$auctionProduct->company->name}}</div>
                                <div><span><b>Brand:</b></span> {{$auctionProduct->brand}}</div>
                                <div><span><b>Model:</b></span> {{$auctionProduct->model}}</div>
                                <div><span><b>Description:</b></span> {{$auctionProduct->description}}</div>
                                <div><span><b>Year:</b></span> {{$auctionProduct->year}}</div>
                                <div><span><b>Condition:</b></span> {{$auctionProduct->condition}}</div>
                                <div><span><b>More condition:</b></span> {{$auctionProduct->more_condition}}</div>
                                <div><span><b>Start price:</b></span> {{$auctionProduct->price}}</div>
                                <div><span><b>Now price:</b></span> {{$auctionProduct->auction_price}}</div>
                                <div><span><b>Start Date:</b></span> {{$auctionProduct->auction_start}}</div>
                                <div><span><b>End Date:</b></span> {{$auctionProduct->auction_end}}</div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Bid</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($auctionProduct->auctionHistory as $item)
                                        <tr>
                                            <td>{{$item->company->name}}</td>
                                            <td>${{$item->price}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

    <!-- page script -->
    <script>

        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "searching": false,
                "dom": 'Bfrtip',
                "buttons": []
            });

        });
        $('.toastrDefaultSuccess').click(function() {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
    </script>

@endsection
