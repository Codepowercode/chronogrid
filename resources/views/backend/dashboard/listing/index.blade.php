@extends('layouts.dashboard')


@section('title')
    <title>Subscription</title>
@endsection

@section('css')
    <style>
        span.select2-selection.select2-selection--single{
            height: 38px;
        }

        span.select2-selection__arrow{
            margin-top: 5px;
        }

        .button-search{

        }

        .form-search{
            /*display: flex;*/
        }


        .custom-upload-file{
            text-align:center;
            width: 50%;
            border:thin solid #343a4063;
            border-radius: 5px;
            display: grid;
            margin: 0 auto;
        }
        .custom-form{
            width: 100%;
            padding: 15px;
        }

        #inputTag{
            display: none;
        }
        #inputTagZip{
            display: none;
        }
        label{
            cursor:pointer;
            width: 100%;
        }
        #imageName{
            color:green;
        }
        #imageNameZip{
            color:green;
        }
        @media only screen and (max-width: 600px) {
            .wrapper {
                background-color: lightblue;
            }
        }

        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }
        .loader {
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
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
                        <h1>Listing</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Listing</li>
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
                            <a href="{{route('listing.create')}}" class="btn btn-success" style="float: right; margin: 15px">Create</a>
                            @can('dashboard_listing_create')
                            <div class="card-header" style="display: flex;">


                                <div class="load-wating-custom ">
                                </div>
                                <form action="{{route('listing.store')}}" method="post" enctype="multipart/form-data" class="custom-form">
                                    @csrf
                                    @method('POST')
                                    <div class="custom-upload-file"  @if ($errors->any()) style="border: 1px solid red;" @endif>
                                        <div style="display: flex">
                                            <label for="inputTag">
                                                Select Excel max(2mb)<br/>
                                                <i class="fas fa-2x fa-file-alt"></i>
                                                <input id="inputTag" type="file"  name="import_file"  accept=".xlsx, .csv" />
                                                <br/>
                                                <span id="imageName">
                                                @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <strong style="color: red">{{ $error }}</strong> <br>
                                                        @endforeach
                                                    @else
                                                        ----
                                                    @endif
                                            </span>
                                            </label>
                                            <label for="inputTagZip" style="    border-left: 1px solid #b0b3b5;">
                                                Select Zip max(50mb)<br/>
                                                <i class="fas fa-2x fa-file-archive"></i>
                                                <input id="inputTagZip" type="file"  name="import_file_zip"  accept=".zip"  />
                                                <br/>
                                                <span id="imageNameZip">
                                                @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <strong style="color: red">{{ $error }}</strong> <br>
                                                        @endforeach
                                                    @else
                                                        ----
                                                    @endif
                                            </span>
                                            </label>
                                        </div>
                                        <br>
                                        <button id="custom-upload-button" type="submit" data-access="true" class="btn @if ($errors->any()) btn-danger @else btn-success @endif">@if ($errors->any()) Error @else Add to listing @endif </button>
                                    </div>
                                </form>
                                <div><a href="{{route('delete.all')}}" class="btn btn-danger" onclick="return confirm('Are you sure delete all items?');" >Delete All List</a></div>

                            </div>
                            @endcan

                                <div class="" style="margin-top: 10px; margin-left: 10px">
                                    <form class="form-search" method="GET" action="{{route('listing.filter')}}">
                                        <!-- @csrf -->
                                        <!-- @method('GET') -->
                                        <div class="row">
                                        <div class="col-3">
                                            <lable><b>Brand</b></lable>
                                            <select class="form-control select2" name="brand_name" id="">
                                                <option value="" selected >All</option>
                                                @foreach($brands as $brand)
                                                    <option  @if(isset($brandName) && $brandName == $brand) selected @else   @endif value="{{$brand}}">{{$brand}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <lable><b>Model</b></lable>
                                            <select class="form-control select2" name="model_name" id="">
                                                <option value="" selected >All</option>
                                                @foreach($models as $model)
                                                    <option @if(isset($modelName) && $modelName == $model) selected @else  @endif value="{{$model}}">{{$model}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <lable><b>Descriptions ( Model Number )</b></lable>
                                            <select class="form-control select2" name="description_name" id="">
                                                <option value="" selected >All</option>
                                                @foreach($descriptions as $description)
                                                    <option @if(isset($descriptionName) && $descriptionName == $description) selected @else   @endif value="{{$description}}">{{$description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <button class="btn btn-success button-search" type="submit" style="    margin-top: 24px;    height: 100%;">Filter</button>
                                        </div>
                                    </form>
                                </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Metal</th>
                                        <th>Description (model number)</th>
                                        <th>Description1</th>
                                        <th>Full description</th>
                                        <th>Model text</th>
                                        <th>Model description</th>
                                        <th>Full size</th>
                                        <th>Bezel material</th>
                                        <th>Bezel type</th>
                                        <th>Band material</th>
                                        <th>Band type</th>
                                        <th>Dial</th>
                                        <th>Dial markers</th>
                                        <th>Retail</th>
                                        <th>Year</th>
{{--                                        <th>Image</th>--}}
                                        <th>Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listings as $listing)
                                        <tr>
                                            <td>{{$listing->brand}}</td>
                                            <td>{{$listing->model}}</td>
                                            <td>{{$listing->metal}}</td>
                                            <td>{{$listing->description}}</td>
                                            <td>{{$listing->description1}}</td>
                                            <td>{{$listing->full_description}}</td>
                                            <td>{{$listing->model_text}}</td>
                                            <td>{{$listing->model_description}}</td>
                                            <td>{{$listing->size}}</td>
                                            <td>{{$listing->bezel_material}}</td>
                                            <td>{{$listing->bezel_type}}</td>
                                            <td>{{$listing->band_material}}</td>
                                            <td>{{$listing->band_type}}</td>
                                            <td>{{$listing->dial}}</td>
                                            <td>{{$listing->dial_markers}}</td>
                                            <td>{{$listing->retail}}</td>
                                            <td>{{$listing->year}}</td>
{{--                                            <td>{{$listing->path}}</td>--}}
                                            <td>
                                                <div class="d-flex">
                                                    @can('dashboard_listing_edit')
                                                    <a style="padding: 0px 5px;" href="{{ route('listing.edit', $listing->id) }}" data-id="{{$listing->id}}" class="btn btn-primary"><i  class="fas fa-edit" ></i></a>
                                                    @endcan
                                                    @can('dashboard_listing_delete')
                                                    <form method="POST" action="{{ route('listing.destroy' , $listing->id) }}">
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
                            {{$listings->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
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
{{--    <div class="load-wating-custom ">--}}

{{--    </div>--}}


@endsection

@section('js')

    <script>
        $('#custom-upload-button').attr('disabled', 'disabled')
        // $('.custom-upload-button').attr('style', 'display:none')
        $('#inputTag').change(function(e) {
            let geekss = e.target.files[0].name;
            let size = e.target.files[0].size;
            if(size > 2300000){
                $('#custom-upload-button').attr('disabled', 'disabled')
                $("#imageName").attr('style', 'color: red;').html( `ERROR ${( size / (1024 ** 2)).toFixed(2)}`);
                return;
            }
             $('#custom-upload-button').removeAttr('disabled')
                if (geekss) {
                    $('#custom-upload-button').removeAttr('disabled')
                }
                $("#imageName").html(geekss);
                $('.custom-upload-file').attr('style', 'border: thin solid #28a745;')

                if ($('#custom-upload-button').hasClass('btn-danger')) {
                    $('#custom-upload-button').removeClass('btn-danger')
                    $('#custom-upload-button').addClass('btn-success')
                    $('#custom-upload-button').html('Add to listing')
                }
            // $('.custom-upload-button').attr('style', 'display:block')
        });

        $('#inputTagZip').change(function(e) {
            console.log(e.target.files)
            let geekss = e.target.files[0].name;
            let size = e.target.files[0].size;
            if(size > 53000000){
                $('#custom-upload-button').attr('disabled', 'disabled')
                $("#imageNameZip").attr('style', 'color: red;').html( `ERROR ${( size / (1024 ** 2)).toFixed(2)}`);
                return;
            }
            console.log(geekss)
            $('#custom-upload-button').removeAttr('disabled')
            if(geekss){
                $('#custom-upload-button-zip').removeAttr('disabled')
            }

            $("#imageNameZip").attr('style', 'color: green;').html(geekss);
            $('.custom-upload-file-zip').attr('style', 'border: thin solid #28a745;')

            if($('#custom-upload-button-zip').hasClass('btn-danger')){
                $('#custom-upload-button-zip').removeClass('btn-danger')
                $('#custom-upload-button-zip').addClass('btn-success')
                $('#custom-upload-button-zip').html('Add to zip images')
            }
            // $('.custom-upload-button').attr('style', 'display:block')
        });

        $(document).on('click', '#custom-upload-button', function () {
            //
            $('.load-wating-custom').html(`
           <div style=" background: #8080805e; position: absolute; width: 100%; height: 100%; top: 0px;left: 0px;overflow: hidden;z-index: 999999999;">
                <div class="loader" style="position: absolute;top: 0%;left: 47%;">Loading...</div>
           </div>
            `)
            setTimeout(()=>{
                $('.load-wating').html('');
            }, 20000)
        })
    </script>
@endsection
