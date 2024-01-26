@extends('layouts.dashboard')


@section('title')
    <title>Create</title>
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
                        <h1>Listing Edit</h1>
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
        @can('dashboard_listing_edit')
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('create.listing')}}" method="post" id="quickForm" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="text" name="brand" value="{{old('brand')}}" class="form-control" placeholder="Brand">
                                    </div>
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" name="model" value="{{old('model')}}" class="form-control" placeholder="Model">
                                    </div>
                                    <div class="form-group">
                                        <label>Metal</label>
                                        <input type="text" name="metal" value="{{old('metal')}}" class="form-control" placeholder="Metal">
                                    </div>
                                    <div class="form-group">
                                        <label>Description (model number)</label>
                                        <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="Model number">
                                    </div>
                                    <div class="form-group">
                                        <label>Description1</label>
                                        <input type="text" name="description1" value="{{old('description1')}}" class="form-control" placeholder="Description1">
                                    </div>
                                    <div class="form-group">
                                        <label>Full description</label>
                                        <input type="text" name="full_description" value="{{old('full_description')}}" class="form-control" placeholder="Full description">
                                    </div>
                                    <div class="form-group">
                                        <label>Model text</label>
                                        <input type="text" name="model_text" value="{{old('model_text')}}" class="form-control" placeholder="Model text">
                                    </div>
                                    <div class="form-group">
                                        <label>Model description</label>
                                        <input type="text" name="model_description" value="{{old('model_description')}}" class="form-control" placeholder="Model description">
                                    </div>
                                    <div class="form-group">
                                        <label>Full size</label>
                                        <input type="text" name="size" value="{{old('size')}}" class="form-control" placeholder="Full size">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bezel material</label>
                                        <input  type="text" name="bezel_material"  value="{{old('bezel_material')}}" class="form-control" placeholder="Bezel material">
                                    </div>
                                    <div class="form-group">
                                        <label>Bezel type</label>
                                        <input  type="text" name="bezel_type" class="form-control" value="{{old('bezel_type')}}" max="100" placeholder="Bezel type">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Bezel size</label>
                                        <input  type="text" name="bezel_size" class="form-control" value="{{old('bezel_size')}}" max="100" placeholder="Bezel type">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Band material</label>
                                        <input  type="text" name="band_material"  value="{{old('band_material')}}" class="form-control" placeholder="Band material">
                                    </div>
                                    <div class="form-group">
                                        <label>Band type</label>
                                        <input  type="text" name="band_type"  value="{{old('band_type')}}" class="form-control" placeholder="Band type">
                                    </div>
                                    <div class="form-group">
                                        <label>Dial</label>
                                        <input  type="text" name="dial"  value="{{old('dial')}}" class="form-control" placeholder="Dial">
                                    </div>
                                    <div class="form-group">
                                        <label>Dial markers</label>
                                        <input  type="text" name="dial_markers"  value="{{old('dial_markers')}}" class="form-control" placeholder="Dial markers">
                                    </div>
                                    <div class="form-group">
                                        <label>Retail</label>
                                        <input  type="text" name="retail"  value="{{old('retail')}}" class="form-control" placeholder="Retail">
                                    </div>
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input  type="text" name="year"  value="{{old('year')}}" class="form-control" placeholder="Year">
                                    </div>
{{--                                    {{dd(substr($listing->path, 7))}}--}}
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"  class="custom-file-input" name="file" id="imgfilesOne" >
                                                <label class="custom-file-label" for="imgfilesOne">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="img-view-one">

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
    <script !src="">
        $('#imgfilesOne').on('change', function (e) {
            renderImagesOne();
        })
        $('#img-view-one').on('click', '.removeImageOne', function () {
            let remIndex = Number($(this).attr('data-value'));
            let dt = new DataTransfer();
            for (let i=0; i<$('#imgfilesOne')[0].files.length; i++){
                if (i !== remIndex){
                    dt.items.add($('#imgfilesOne')[0].files[i]);
                }
            }
            $('#imgfilesOne')[0].files = dt.files;
            renderImagesOne();
        })
        function renderImagesOne(){
            let el = $('#img-view-one');
            el.html(``);
            for (let i=0; i<$('#imgfilesOne')[0].files.length; i++){
                let src = URL.createObjectURL($('#imgfilesOne')[0].files[i])
                el.append(`
                    <div style="display:flex; float: left; margin: 10px; position:relative">
                         <img style="width: 160px;" src="${src}">
                    </div>
                `);
            }
        }

    </script>
@endsection


