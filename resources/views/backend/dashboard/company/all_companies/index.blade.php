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
                        <h1>All Companies</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Companies</li>
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
{{--                                @can('dashboard_company_create')--}}
{{--                                <a href="{{route('company.create')}}" class="btn btn-success" style="float: right; margin: 15px">Create</a>--}}
{{--                                @endcan--}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Company name</th>
                                        <th>Email</th>
                                        <th>Subscription</th>
                                        <th>Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{isset($company->subscription) ? $company->subscription->year . ' Year' : 'Unsubscription'}}</td>
                                            <td>
                                                <div class="d-flex">
{{--                                                    @can('dashboard_company_edit')--}}
{{--                                                    <a style="padding: 0px 5px;margin: 0px 8px;" href="{{ route("company.edit", $company->id) }}" class="btn btn-primary edit-access"><i  class="fas fa-edit" ></i></a>--}}
{{--                                                    @endcan--}}
                                                    @can('dashboard_company_info')
                                                        <a style="padding: 0px 5px;margin: 0px 8px 0 0;" href="{{ route("company.show", $company->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-eye"></i></a>
                                                    @endcan
                                                    @can('dashboard_company_view_employee')
                                                        <a style="padding: 0px 5px; margin: 0px 8px 0 0;" href="{{ route("member.index", $company->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-users-rays"></i></a>
                                                    @endcan
                                                    @can('dashboard_company_access_acceptance')
                                                        <a style="padding: 0px 5px;  margin: 0px 8px 0 0;" onclick="return confirm('do you want send new password in email');" href="{{ route("company.access", $company->id) }}" data-id="{{$company->id}}" class="btn btn-primary edit-access"><i class="fas fa-envelope"></i></a>
                                                    @endcan

{{--                                                    <ul class="navbar-nav">--}}
{{--                                                        <li class="nav-item dropdown">--}}
{{--                                                            <a class="" data-toggle="dropdown" href="#">--}}
{{--                                                                <i class="fas fa-egg"></i>--}}
{{--                                                            </a>--}}
{{--                                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                                                <a style="padding: 0px 5px;  margin: 0px 8px 0 0;" onclick="return confirm('do you want send new password in email');"  class="btn btn-primary edit-access"><i class="fa-solid fa-lock"></i></a>--}}
{{--                                                                <a style="padding: 0px 5px;  margin: 0px 8px 0 0;" onclick="return confirm('do you want send new password in email');"  class="btn btn-primary edit-access"><i class="fa-solid fa-users-rays"></i></a>--}}
{{--                                                                <a style="padding: 0px 5px;  margin: 0px 8px 0 0;" onclick="return confirm('do you want send new password in email');"  class="btn btn-primary edit-access"><i class="fas fa-envelope"></i></a>--}}
{{--                                                                <a style="padding: 0px 5px;  margin: 0px 8px 0 0;" onclick="return confirm('do you want send new password in email');"  class="btn btn-primary edit-access"><i class="fa-solid fa-lock"></i></a>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}
{{--                                                    </ul>--}}


                                                    @can('dashboard_company_block')
                                                        <a style="padding: 0px 5px;" href="{{ route("company.block", $company->id) }}" class="btn btn-primary edit-access"><i class="fa-solid fa-lock"></i></a>
                                                    @endcan
                                                    @can('dashboard_company_delete')
                                                        <form method="POST" action="{{ route("company.destroy" , $company->id) }}">
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


@endsection
