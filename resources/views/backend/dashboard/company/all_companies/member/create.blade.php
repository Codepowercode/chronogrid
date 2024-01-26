@extends('layouts.dashboard')


@section('title')
    <title>Create</title>
@endsection

@section('css')
    <style>
        .password_info{
            color: red;
            font-size: 12px;
            margin-left: 15px;
        }
    </style>

@endsection



@section('dashboard')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Member Create</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @can('dashboard_company_employee_create')
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Create</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('member.store', $id)}}" method="post" id="quickForm">
                        @method('POST')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input  type="email" name="email" class="form-control @if($errors->any() && in_array('email.unique', $errors->all()))  is-invalid @endif" value="{{old('email')}}">
                                        @if($errors->any() && in_array('email.unique', $errors->all()))<span class="error invalid-feedback">Email address is unique</span>  @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input  type="text" name="password" class="form-control">
                                        <p class="password_info">If you don't fill in the password, a randomly generated password will be sent to your e-mail.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input  type="hidden" name="company_id" class="form-control" value="{{$id}}" style="display:none;">
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Save</button>
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
                        required: true,
                        minlength: 5
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


