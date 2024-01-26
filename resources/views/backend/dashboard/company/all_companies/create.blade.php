@extends('layouts.dashboard')


@section('title')
    <title>Create</title>
@endsection

@section('css')
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/bankCard/dist/css/DatPayment.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/bankCard/example.css')}}">
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
                        <h1>Company Create</h1>
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
        @can('dashboard_company_create')
        <form action="{{route('company.store')}}" method="post" id="quickForm">
            @method('POST')
            @csrf
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Company</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Company name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"  class="form-control @if($errors->any() && in_array('email.unique', $errors->all()))  is-invalid @endif" placeholder="Enter email" value="">
                                        @if($errors->any() && in_array('email.unique', $errors->all()))<span class="error invalid-feedback">Email address is unique</span>  @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="Password" >
                                        <p class="password_info">If you don't fill in the password, a randomly generated password will be sent to this e-mail.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Subscription</label>
                                        <select class="form-control select2bs4" name="subscription_id" style="width: 100%;">
                                            @foreach($subscriptions as $subscription)
                                                <option value="{{$subscription->id}}">{{$subscription->year}} Year</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-md-6">
                                <div class="card card-default collapsed-card">
                                    <div class="card-header">
                                        <div style="display: none"> {{$key = 0}}</div>
                                        <h3 class="card-title">Info Company</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                            @if($key != 0)  <button type="button"  class="btn btn-tool custom-remove-info"><i class="fas fa-times"></i></button>@endif
                                        </div>
                                    </div>
                                    <div class="card-body" style="display: none;">
                                        <!-- Date dd/mm/yyyy -->
                                        <div class="form-group">
                                            <label>Address 1</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][address1]" value="{{old('address1')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <input type="text"  class="form-control" name="info[{{$key}}][address2]" value="{{old('address2')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][city]" value="{{old('city')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][state]" value="{{old('state')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][postal_code]" value="{{old('postal_code')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][phone_number]" value="{{old('phone_number')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Fax number</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][fax_number]" value="{{old('fax_number')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][website]" value="{{old('website')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Skype</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][skype]" value="{{old('skype')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Cell phone</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][cell_phone]" value="{{old('cell_phone')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Company type</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][company_type]" value="{{old('company_type')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][country]" value="{{old('country')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Business type</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][business_type]" value="{{old('business_type')}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Premium</label>
                                            <input type="text" class="form-control" name="info[{{$key}}][premium]" value="{{old('premium')}}">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            <div class="custom-add-info"></div>
                            <div class="card card-default custom-add-info-button" data-key="{{$key}}" style="background-color: #8080804a; color: grey; cursor: pointer">
                                <div class="card-header" style="text-align: center;margin: 0 auto;display: block;">
                                    <h3  class="card-title">Add info</h3>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
        </form>
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
                        minlength: 5
                    },
                    subscription_id: {
                        required: true
                    },

                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    cvv: {
                        maxlength: "Please enter a vaild email address",
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


    <script>
        $(document).on('click', '.custom-add-info-button', function () {
            let key = $(this).attr('data-key')
            let keyplas = (key*1)+1
            $(this).attr('data-key', keyplas)
            $('.custom-add-info').append(`
                <div class="card card-default collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Info Company</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool custom-remove-info"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    <div class="card-body" style="display: none;">
                <div class="form-group">
                <label>Address 1</label>
                <input type="text" class="form-control" name="info[${keyplas}][address1]" value="">
                </div>
                <div class="form-group">
                <label>Address 2</label>
                <input type="text"  class="form-control" name="info[${keyplas}][address2]" value="">
                </div>
                <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="info[${keyplas}][city]" value="">
                </div>
                <div class="form-group">
                <label>State</label>
                <input type="text" class="form-control" name="info[${keyplas}][state]" value="">
                </div>
                <div class="form-group">
                <label>Postal Code</label>
                <input type="text" class="form-control" name="info[${keyplas}][postal_code]" value="">
                </div>
                <div class="form-group">
                <label>Phone number</label>
                <input type="text" class="form-control" name="info[${keyplas}][phone_number]" value="">
                </div>
                <div class="form-group">
                <label>Fax number</label>
                <input type="text" class="form-control" name="info[${keyplas}][fax_number]" value="">
                </div>
                <div class="form-group">
                <label>Website</label>
                <input type="text" class="form-control" name="info[${keyplas}][website]" value="">
                </div>
                <div class="form-group">
                <label>Skype</label>
                <input type="text" class="form-control" name="info[${keyplas}][skype]" value="">
                </div>
                <div class="form-group">
                <label>Cell phone</label>
                <input type="text" class="form-control" name="info[${keyplas}][cell_phone]" value="">
                </div>
                <div class="form-group">
                <label>Company type</label>
                <input type="text" class="form-control" name="info[${keyplas}][company_type]" value="">
                </div>
                <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control" name="info[${keyplas}][country]" value="">
                </div>
                <div class="form-group">
                <label>Business type</label>
                <input type="text" class="form-control" name="info[${keyplas}][business_type]" value="">
                </div>
                <div class="form-group">
                <label>Premium</label>
                <input type="text" class="form-control" name="info[${keyplas}][premium]" value="">
                </div>
                </div>
                </div>
            `);
        })

        $(document).on('click', '.custom-remove-info', function () {
            if (confirm('Are you sure you want to save this thing into the database?')) {
                // Save it!
                $(this).closest('.card-tools').closest('.card-header').closest('.collapsed-card').remove()
            } else {
                // Do nothing!
                console.log('Thing was not saved to the database.');
            }
        })
    </script>
@endsection


