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
                        <h1>Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div>
                                @can('dashboard_support_create')
                                <a href="{{route('support.create')}}" class="btn btn-success" style="float: right; margin: 15px">Create</a>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Support Name</th>
                                        <th>Role</th>
                                        <th>Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supports as $key => $support)
{{--                                        {{dd($roles)}}--}}
                                        <tr>
                                            <td>{{$support->name}}</td>
                                            <td>
                                                @foreach($support->roles as $role)
                                                    {{$role->name}} <br>
                                                @endforeach
                                                @if(empty($role->toArray()))
                                                   No Role
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('dashboard_support_edit')
                                                    <a style="padding: 0px 5px;" href="{{ route("support.edit", $support->id) }}" data-id="{{$support->id}}" class="btn btn-primary edit-access"><i  class="fas fa-edit" ></i></a>
                                                    @endcan
                                                    @can('dashboard_support_delete')
                                                    <form method="POST" action="{{ route("support.destroy" , $support->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:;" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <button type="submit" style="padding: 0px 5px;" class="ml-2 btn btn-danger" >
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
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
        <!-- /.content -->
{{--        <div class="classANDid">132131321321</div>--}}
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


    <script>
        $('body').on('click', '.classANDid', function () {



            // const asdasdasdasd = {
            //     asdsaasd:asdasdasdasd,
            //     dasd : [
            //         {
            //             name:'asdadasd',
            //             email: ['asdasdas', 'asdasdasdasd0']
            //         },
            //         {
            //             name:'asdadasd',
            //             email: ['asdasdas', 'asdasdasdasd0']
            //         },
            //         {
            //             name:'asdadasd',
            //             email: ['asdasdas', 'asdasdasdasd0']
            //         }
            //     ]
            // }



            // let x = ['admin@gmail.com', 'support@gmail.com', ....]
            let y = ['admin', 'Support', '....']

            $.ajax({
                type: 'post',
                url: '/testsssss/test',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: 132,
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    let keys = Object.keys(res);
                    let currentItem = []
                    let currentItem1 = []
                    keys.map(elem => {
                        let obj = {}
                        let items = res[elem]
                        let arr1 = []
                        let arr2 = []
                        items.map((element,index) => {
                            let arr = Object.values(element)
                            // console.log(arr)
                            arr1.push(arr[0])
                            arr2.push(arr[1])

                            currentItem.push(arr1)
                            currentItem1.push(arr2)

                        })
                        // console.log(items)
                    })
                    console.log(currentItem[0],currentItem[currentItem1.length - 1])
                    console.log(currentItem1[0],currentItem1[currentItem1.length - 1])

                },
                error: function(data) {
                    console.log("OOP ERROR");
                }
            });

        });
    </script>

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
