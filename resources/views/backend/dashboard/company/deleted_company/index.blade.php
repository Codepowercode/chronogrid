@extends('layouts.dashboard')


@section('title')
    <title>Deleted Companies</title>
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
                        <h1>Companies Deleted</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Deleted</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        @can('dashboard_company_tab_deleted_companies')
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Company name</th>
                                            <th>Email</th>
                                            <th>Access</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deletedCompanies as $deletedCompany)
                                                <tr>
                                                    <td>{{$deletedCompany->name}}</td>
                                                    <td>{{$deletedCompany->email}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @can('dashboard_company_show_deleted_companies')
                                                                <a style="padding: 0px 5px;margin: 0px 8px 0 0;" href="{{ route("show.deleted.company", $deletedCompany->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-eye"></i></a>
                                                            @endcan
                                                            @can('dashboard_company_deleted_companies_delete')
                                                            <form method="POST" action="{{ route("destroy.deleted.company" , $deletedCompany->id) }}">
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
