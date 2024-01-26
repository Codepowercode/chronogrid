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
                        <h1>Subscription Edit</h1>
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
        @can('dashboard_subscription_edit')
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('subscription.update', $subscription->id )}}" method="post" id="quickForm">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date (Year)</label>
                                        <input type="number" name="year" value="{{$subscription->year}}" class="form-control" placeholder="5">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{$subscription->name}}" class="form-control" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="position: relative">
                                        <label>Price</label>
                                        <span style="position: absolute;top: 39px;left: 10px;">$</span>
                                        <input  type="number" name="price"  value="{{$subscription->price}}" class="form-control" style="padding-left: 20px;" placeholder="100">
                                    </div>
                                    <div class="form-group" style="position: relative">
                                        <label>Sale</label>
                                        <span style="position: absolute;top: 39px;left: 10px;">%</span>
                                        <input  type="number" name="sale" class="form-control" value="{{$subscription->sale}}" max="100" style="padding-left: 25px;" placeholder="100">
                                    </div>
                                </div>
                            </div>
                        </div>

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
                    year: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                },
                messages: {
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


