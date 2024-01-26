<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Listing\EditRequest;
use App\Http\Requests\Api\Product\ProductCSVRequest;
use App\Http\Services\ProductService;
use App\Jobs\TestJob;
use App\Mail\SendDemoMail;
use App\Mail\TestMail;
use App\Models\Listing;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($data = null, $request = null)
    {
//
//        $maildata = [
//            'email' => 'david656558a@gmail.com' ,
//            'name' => 'Amigo' ,
//            'title' => 'Laravel Mail Sending Example with Markdown 111111111123sdsad sad asd ad asd asd',
//            'url' => 'https://www.positronx.io'
//        ];
//
//        dispatch(new TestJob($maildata));
//
//        dd("RUN JOB - Mail has been sent successfully");

        $listings = Listing::query()->orderByDesc('id')->paginate(10);
        $modelName = null;
        $brandName = null;
        $descriptionName = null;

        $models = Listing::query()->distinct()->pluck('model');
        $brands = Listing::query()->distinct()->pluck('brand');
        $descriptions = Listing::query()->distinct()->pluck('description');

        return view('backend.dashboard.listing.index', compact('listings', 'models', 'brands', 'descriptions', 'modelName', 'brandName', 'descriptionName'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function filter(Request $request)
    {
        $listings = Listing::query();
        if (isset($request->brand_name)){
            $listings = $listings->where('brand', $request->brand_name);
        }
        if (isset($request->model_name)) {
            $listings = $listings->where('model', $request->model_name);
        }
        if (isset($request->description_name)) {
            $listings = $listings->where('description', $request->description_name);
        }

        $listings = $listings->orderByDesc('id')->paginate(10);

        $modelName = $request['model_name'];
        $brandName = $request['brand_name'];
        $descriptionName = $request['description_name'];


        $models = Listing::query()->distinct()->pluck('model');
        $brands = Listing::query()->distinct()->pluck('brand');
        $descriptions = Listing::query()->distinct()->pluck('description');



        return view('backend.dashboard.listing.index', compact('listings', 'models', 'brands', 'descriptions', 'modelName', 'brandName', 'descriptionName'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.dashboard.listing.create');
    }

    /**
     * @param EditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createListing(EditRequest $request)
    {
        $listing = new Listing();
        $listing->brand = $request->brand;
        $listing->model = $request->model;
        $listing->metal = $request->metal;
        $listing->description = $request->description;
        $listing->description1 = $request->description1;
        $listing->full_description = $request->full_description;
        $listing->model_text = $request->model_text;
        $listing->model_description = $request->model_description;
        $listing->size = $request->size;
        $listing->bezel_material = $request->bezel_material;
        $listing->bezel_type = $request->bezel_type;
        $listing->bezel_size = isset($request->bezel_size) ? $request->bezel_size : null;
        $listing->band_material = $request->band_material;
        $listing->band_type = $request->band_type;
        $listing->dial = $request->dial;
        $listing->dial_markers = $request->dial_markers;
        $listing->retail = $request->retail;
        $listing->year =  $request->year;
        $listing->hash = md5($request->brand.$request->model.$request->metal.$request->size.$request->bezel_material.$request->bezel_type);
        $listing->json = json_encode(['brand' => $request->brand,'model' => $request->model,'metal' => $request->metal,'size' => $request->size,'bezel_material' => $request->bezel_material,'bezel_type' => $request->bezel_type]);


        if ($request->file){
            $image = $request->file;
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'unzip' . DIRECTORY_SEPARATOR );
            $fileName =  Hellper::upload($image, $path);
            $imagePath = "/public/storage/unzip/" . $fileName;
            $listing->path = $imagePath;
        }
        $listing->save();

        return redirect()->route('listing.index')->with('success', 'Success Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCSVRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();

            // zip file
            if ($request->import_file_zip){
                $fileTypeZip = array_reverse(explode('.', $request->import_file_zip->getClientOriginalName()));
                if ($fileTypeZip[0] === 'zip') {
                    if (filesize($request->import_file_zip) > 54000000) { // 50000000byte ~ 50mb
                        return redirect()->back()->withErrors(['Wrong file size, max size 50mb']);
                    }

                    $status = $this->zip($request->all());
                    if ($status){
                        return redirect()->back()->withErrors(['Wrong file type, zip']);
                    }
                }elseif (!isset($request->import_file)){
                    return redirect()->back()->withErrors(['Wrong file type, csv or xlsx']);
                }
            }

            // excel file
            if ($request->import_file) {
                $fileType = array_reverse(explode('.', $request->import_file->getClientOriginalName()));
                if ($fileType[0] === 'csv' || $fileType[0] === 'xlsx') {
                    if (filesize($request->import_file) > 2400000) { // 2000000byte ~ 2mb
                        return redirect()->back()->withErrors(['Wrong file size, max size 2mb']);
                    }
                    $service = new ProductService();
                    $service->productListCSV($request->all());
                }elseif (!isset($request->import_file_zip)){
                    return redirect()->back()->withErrors(['Wrong file type, csv or xlsx']);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Success added');

        }catch (\Exception $e){
            DB::rollBack();
            //File::delete(1); //delete file
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        return view('backend.dashboard.listing.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, $id) //EditRequest
    {
        $listing = Listing::findOrFail($id);
        $listing->brand = $request->brand;
        $listing->model = $request->model;
        $listing->metal = $request->metal;
        $listing->description = $request->description;
        $listing->description1 = $request->description1;
        $listing->full_description = $request->full_description;
        $listing->model_text = $request->model_text;
        $listing->model_description = $request->model_description;
        $listing->size = $request->size;
        $listing->bezel_material = $request->bezel_material;
        $listing->bezel_type = $request->bezel_type;
        $listing->bezel_size = isset($request->bezel_size) ? $request->bezel_size : null;
        $listing->band_material = $request->band_material;
        $listing->band_type = $request->band_type;
        $listing->dial = $request->dial;
        $listing->dial_markers = $request->dial_markers;
        $listing->retail = $request->retail;
        $listing->year =  $request->year;
        $listing->hash = md5($request->brand.$request->model.$request->metal.$request->size.$request->bezel_material.$request->bezel_type);
        $listing->json = json_encode(['brand' => $request->brand,'model' => $request->model,'metal' => $request->metal,'size' => $request->size,'bezel_material' => $request->bezel_material,'bezel_type' => $request->bezel_type]);


        if ($request->file){
            $image = $request->file;
            if($listing->path !== null){
                $productImage = str_replace('/storage', '', substr($listing->path, 7));
                Storage::delete('/public'.$productImage);
            }
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'unzip' . DIRECTORY_SEPARATOR );
            $fileName =  Hellper::upload($image, $path);
            $imagePath = "/public/storage/unzip/" . $fileName;
            $listing->path = $imagePath;
        }
        $listing->save();

        return redirect()->route('listing.index')->with('success', 'Success edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();
        return redirect()->back()->with('success', 'Success Deleted');
    }


    public function zip($request, $path = null)
    {
        $zip = new ZipArchive();
        $status = $zip->open($request['import_file_zip']->getRealPath());

        if ($status !== true) {
            throw new \Exception($status);
        }
        else{
            if ($path === null){
                $path = "app/public/unzip/";
            }
            $storageDestinationPath= storage_path($path);
            if (!\File::exists( $storageDestinationPath)) {
                \File::makeDirectory($storageDestinationPath, 0755, true);
            }
            $zip->extractTo($storageDestinationPath);
            $zip->close();
            return false;
        }
        return true;
    }


    public function deleteAllListing()
    {
        Listing::query()->delete();
        return redirect()->back()->with('success', 'Success Deleted');
    }


}
