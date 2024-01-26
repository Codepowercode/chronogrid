@extends('layouts.dashboard')


@section('title')
    <title>Edit</title>
@endsection

@section('css')

@endsection

@section('dashboard')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Role Edit</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @can('dashboard_support_edit')
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
{{--                    {{dd($role->permissions->pluck('name')->toArray())}}--}}
                    <!-- /.card-header -->
                    <form role="form" action="{{ route('support.update',  $support->id)}}" method="POST"  id="quickForm">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" value="{{$support->name}}" placeholder="Name">
                            </div>
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" value="{{$support->email}}"  placeholder="Email">
                            </div>
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="text" name="password" class="form-control"  placeholder="Password">
                            </div>
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1">Password Confirmation</label>
                                <input type="text" name="password_confirmation" class="form-control"  placeholder="Password Confirmation">
                            </div>
{{--                            {{dd($role->name, $support->roles->pluck('name')->toArray())}}--}}
                            @can('dashboard_support_role_edit')
                            <div class="form-group col-12">
                                <label>Role</label>
                                <select class="form-control select2bs4" name="role" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" {{in_array($role->name, $support->roles->pluck('name')->toArray()) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endcan
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>

                    </form>
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </section>
        @endcan
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection


