@extends('layouts.dashboard')


@section('title')
    <title>Show</title>
@endsection

@section('css')
    <style>
        .border-show-info{
            border: 1px solid #cdcdcd;
            padding: 5px;
            border-radius: 5px;
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

        <!-- Main content -->
        @can('dashboard_company_show_deleted_companies')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Company</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Position id</label>
                                    <div class="border-show-info">{{$deletedCompany->position_id}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Company name</label>
                                    <div class="border-show-info">{{$deletedCompany->name}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="border-show-info">{{$deletedCompany->email}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <div class="border-show-info">{{$deletedCompany->rating}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Reset password code</label>
                                    <div class="border-show-info">{{$deletedCompany->reset_password_code}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Blocked subscription</label>
                                    <div class="border-show-info">{{$deletedCompany->blocked_subscription}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Login blocked</label>
                                    <div class="border-show-info">{{$deletedCompany->login_blocked}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Blocked</label>
                                    <div class="border-show-info">{{$deletedCompany->blocked}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Subscription id</label>
                                    <div class="border-show-info">{{$deletedCompany->subscription_id}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Subscription Start</label>
                                    <div class="border-show-info">{{$deletedCompany->subscription_start}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Deleted at</label>
                                    <div class="border-show-info">{{$deletedCompany->created_at}}</div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                     {{--   @foreach($company->info as $key => $info)
                            <div class="card card-default collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Info Company ( {{$key+1}} )</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="display: none;">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <div class="border-show-info">{{isset($info->address1) ? $info->address1 : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <div class="border-show-info">{{isset($info->address2) ? $info->address2 : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <div class="border-show-info">{{isset($info->city) ? $info->city : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <div class="border-show-info">{{isset($info->state) ? $info->state : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <div class="border-show-info">{{isset($info->postal_code) ? $info->postal_code : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <div class="border-show-info">{{isset($info->phone_number) ? $info->phone_number : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Fax number</label>
                                    <div class="border-show-info">{{isset($info->fax_number) ? $info->fax_number : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <div class="border-show-info"><a href="{{isset($info->website) ? $info->website : '#'}}">{{isset($info->website) ? $info->website : '---'}}</a></div>
                                </div>
                                <div class="form-group">
                                    <label>Skype</label>
                                    <div class="border-show-info">{{isset($info->skype) ? $info->skype : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Cell phone</label>
                                    <div class="border-show-info">{{isset($info->cell_phone) ? $info->cell_phone : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Company type</label>
                                    <div class="border-show-info">{{isset($info->company_type) ? $info->company_type : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <div class="border-show-info">{{isset($info->country) ? $info->country : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Business type</label>
                                    <div class="border-show-info">{{isset($info->business_type) ? $info->business_type : '---'}}</div>
                                </div>
                                <div class="form-group">
                                    <label>Premium</label>
                                    <div class="border-show-info">{{isset($info->premium) ? $info->premium : '---'}}</div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        @endforeach--}}
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


