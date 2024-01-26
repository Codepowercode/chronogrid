<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Product;
use App\Models\ProductError;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ProductVerifyController extends Controller
{
    public function index(){
//        $verifys = ProductError::with('user')->get();
        $verifys = Product::where('blocked_product', 0)->with('company')->get();
        return view('backend.dashboard.productVerify.index', compact('verifys'));
    }

    public function show($id){
        $verify = Product::findOrFail($id)->load('company');
//        isset($verify->error) ? $decode = json_decode($verify->error) : $decode = json_decode($verify->similar);
        return view('backend.dashboard.productVerify.show', compact('verify'));
    }

    public function verify(Request $request, $id){
//        dd($request->all(), $id);
        $product = Product::findOrFail($id)->load('company');
//        dd($product);
        $messagedel = '';
        $messagelist = '';
        $messageadd = '';
        try {
            DB::beginTransaction();
            if ($request->access == 'on'){
                $product->blocked_product = 1;
                $product->status = 1;
                $product->save();

                $messageadd = ' added in products company,';
            }

            if ($request->add_listing == 'on'){
                $list = Listing::create([
                    'brand' => $product->brand,
                    'description' => $product->description,
                    'model' => $product->model,
                    'size' => $product->size.'mm',
                    'metal' => $product->metal,
                    'bezel_type' => $product->bezel_type,
                    'bezel_material' => $product->bezel_metal,
                    'band_type' => null,
                    'dial' => $product->dial,
                    'retail' => null,
                    'model_text' => null,
                    'model_description' => null,
                    'band_material' => null,
                    'dial_markers' => null,
                    'path' => file_exists($product->image) ? $product->image : '/assets/custom/img/default-img.png',
                    'description1' => null,
                    'full_description' => null,
                    'hash' => md5($product->brand.$product->model.$product->metal.$product->size.$product->bezel_metal.$product->bezel_type),
                    'json' => json_encode(['brand' => $product->brand,'model' => $product->model,'metal' => $product->metal,'size' => $product->size,'bezel_material' => $product->bezel_metal,'bezel_type' => $product->bezel_type]),

                ]);
                $messagelist = ' added listing,';
            }


            DB::commit();

            return redirect()->route('product.verify.index')->with('success', 'Success '.$messageadd.$messagelist.$messagedel);

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('product.verify.show', $id)->with('error', 'Error '.$messageadd.$messagelist.$messagedel);
        }


    }

    public function delete($id){
        $verify = Product::findOrFail($id);
        $verify->status = 0;
        $verify->blocked_product = 0;
        $verify->status_position = 'rejected';
        $verify->save();
        return redirect()->route('product.verify.index')->with('success', 'Success blocked');
    }

    public function status(){

    }

}
