@extends('layouts.dashboard')


@section('title')
    <title>Company</title>
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
                        <h1>Members in company "{{$company->name}}"</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Members</li>
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
                                @can('dashboard_company_employee_create')
                                <a href="{{route('member.create', $id)}}" class="btn btn-success" style="float: right; margin: 15px">Create</a>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Blocked</th>
                                        <th>Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>@if($member->login_blocked == 1)<span style="background: red;padding: 6px;color: black;border-radius: 7px;">Blocked</span>@else <span style="background: #00ff00;padding: 6px;color: black;border-radius: 7px;">Unblock</span> @endif</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('dashboard_company_employee_edit')
                                                    <a style="padding: 0px 5px;margin: 0px 8px 0 0;"  href="{{ route("member.edit", [$member->id, $id]) }}" class="btn btn-primary edit-access"><i  class="fas fa-edit" ></i></a>
                                                    @endcan
                                                    @can('dashboard_company_employee_block_unblock')
                                                        @if($member->login_blocked)
                                                                <a style="padding: 0px 5px;" href="{{ route("member.block", $member->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-unlock"></i></a>
                                                            @else
                                                                <a style="padding: 0px 5px; "  href="{{ route("member.block", $member->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-lock"></i></a>
                                                        @endif
                                                    @endcan
                                                    @can('dashboard_company_employee_delete')
                                                    <form method="POST" action="{{ route("member.destroy" , [$member->id, $id]) }}">
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
