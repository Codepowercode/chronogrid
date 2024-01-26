@extends('layouts.dashboard')


@section('title')
    <title>Edit</title>
@endsection

@section('css')
    <style>
        .border-show-info{
            border: 1px solid #cdcdcd;
            padding: 5px;
            border-radius: 5px;
        }
        .show-block-true{
            color: white;
            background: red;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            display: grid;
        }
        .show-unblock-false{
            color: black;
            background: rgba(128, 128, 128, 0.43);
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            display: grid;
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
                        <h1>Company Show</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
{{--        {{dd($company)}}--}}
        <!-- Main content -->
        @can('dashboard_company_info')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Company</h3>
                            </div>
                            <div class="card-body row">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group col-12">
                                    <label>Id</label>
                                    <div class="border-show-info">{{$company->id}}</div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Company name</label>
                                    <div class="border-show-info">{{$company->name}}</div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Email</label>
                                    <div class="border-show-info">{{$company->email}}</div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Subscription</label>
                                    <div class="border-show-info" style="text-align: center;"> {{isset($company->subscription->year) ? $company->subscription->year .' Year' : 'Unsubscription'}}</div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Blocked Subscription</label>
                                    <div>@if($company->blocked_subscription)<span class="show-block-true"> Blocked </span> @else <span class="show-unblock-false"> Unblocked </span>@endif</div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Login Blocked</label>
                                    <div>@if($company->login_blocked)<span class="show-block-true"> Blocked </span> @else <span class="show-unblock-false"> Unblocked </span>@endif</div>
                                </div>
                                <div class="form-group col-3">
                                    <label>Blocked</label>
                                    <div>@if($company->blocked)<span class="show-block-true"> Blocked </span> @else <span class="show-unblock-false"> Unblocked </span>@endif</div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        @if(!empty($company->address->toArray()))
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Address</h3>
                                    </div>
                                    <div class="card-body row">
                                        <!-- Date dd/mm/yyyy -->
                                        @foreach($company->address as $address)
                                            <div class="form-group col-12">
                                                <label>Type</label>
                                                <div class="border-show-info">{{$address->type ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Address 1</label>
                                                <div class="border-show-info">{{$address->address_1 ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Address 2</label>
                                                <div class="border-show-info">{{$address->address_2 ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>City</label>
                                                <div class="border-show-info">{{$address->city ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>State</label>
                                                <div class="border-show-info">{{$address->state ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Postal code</label>
                                                <div class="border-show-info">{{$address->postal_code ?? 'No data'}}</div>
                                            </div>
                                            <div class="form-group col-12">
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Information</h3>
                            </div>
                            <div class="card-body row">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group col-12">
                                    <label>Type</label>
                                    <div class="border-show-info">{{$company->info->type ?? 'No data'}}</div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Phone number</label>
                                    <div class="border-show-info">{{'+'.$company->info->phone_number ?? 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Alt phone number</label>
                                    <div class="border-show-info">{{'+'.$company->info->alt_phone_number ?? 'No data'}}</div>
                                </div>
{{--                                <div class="form-group col-12">--}}
{{--                                    <label>Company contact</label>--}}
{{--                                    <div class="border-show-info">{{$company->info->company_contact ?? 'No data'}}</div>--}}
{{--                                </div>--}}
                                <div class="form-group col-12">
                                    <label>About company</label>
                                    <div class="border-show-info">{{isset($company->info->about_company) ? $company->info->about_company : 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Business hours</label>
                                    <div class="border-show-info">
                                        @if(isset($company->info->business_hours))
                                            @foreach(json_decode($company->info->business_hours) as $hours)
                                                <?php  $data = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] ?>
                                                <p>{{$data[$hours->weekday-1] ?? ''}} from: {{$hours->from ?? ''}} to: {{$hours->to ?? ''}}</p>
                                                <hr>
                                            @endforeach
                                        @else
                                            No Data
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Trade</label>
                                    <div class="border-show-info">
                                        @if(isset($company->info->trade))
                                            @foreach(json_decode($company->info->trade) as $trade)
                                                @if($trade->contact_name || $trade->company_name || $trade->company_number || $trade->cell_phone || $trade->email)
                                                    <div><span style="font-weight: 700">Contact name:</span> {{$trade->contact_name ?? 'No data'}}</div>
                                                    <div><span style="font-weight: 700">Company name:</span> {{$trade->company_name ?? 'No data'}}</div>
                                                    <div><span style="font-weight: 700">Company Number:</span> {{$trade->company_number ?? 'No data'}}</div>
                                                    <div><span style="font-weight: 700">Cell Phone/Direct Number:</span> {{$trade->cell_phone ?? 'No data'}}</div>
                                                    <div><span style="font-weight: 700">Email:</span> {{$trade->email ?? 'No data'}}</div>
                                                    <hr>
                                                @endif
                                            @endforeach
                                        @else
                                            No Data
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>Iwjg</label>
                                    <div class="border-show-info">{{isset($company->info->iwjg_member_number) ? $company->info->iwjg_member_number : 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Rapnet</label>
                                    <div class="border-show-info">{{isset($company->info->rapnet_member_number) ? $company->info->rapnet_member_number : 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Jbt</label>
                                    <div class="border-show-info">{{isset($company->info->jbt_member_number) ? $company->info->jbt_member_number : 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Poligon</label>
                                    <div class="border-show-info">{{isset($company->info->poligon_member_number) ? $company->info->poligon_member_number : 'No data'}}</div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Tawd</label>
                                    <div class="border-show-info">{{isset($company->info->tawd) ? 'Checked' : 'No data'}}</div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Bank Information</h3>
                            </div>
                            <div class="card-body row">
                                <!-- Date dd/mm/yyyy -->
                                @if($company->info->bank_information)
                                    <div class="form-group col-12">
                                        <label>Bank name</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_name'] ?? 'No data'}}</div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Account number</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['account_number'] ?? 'No data'}}</div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Routing number</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['routing_number'] ?? 'No data'}}</div>
                                    </div>
{{--                                    <div class="form-group col-12">--}}
{{--                                        <label>Bank addresss 1</label>--}}
{{--                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_addresss_line1'] ?? 'No data'}}</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-12">--}}
{{--                                        <label>Bank addresss 2</label>--}}
{{--                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_addresss_line2'] ?? 'No data'}}</div>--}}
{{--                                    </div>--}}
                                    <div class="form-group col-12">
                                        <label>Bank city</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_city'] ?? 'No data'}}</div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Bank state</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_state'] ?? 'No data'}}</div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Bank postal code</label>
                                        <div class="border-show-info">{{json_decode($company->info->bank_information, true)['bank_postal_code'] ?? 'No data'}}</div>
                                    </div>
                                @else
                                    <div class="form-group col-12">
                                        <label>No Bank information</label>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </section>
        @endcan
        <!-- /.content -->
    </div>
@endsection

@section('js')

@endsection


