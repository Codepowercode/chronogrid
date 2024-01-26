<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index(){
        $auctionProducts = Product::where('auction', 1)->where('auction_end', '>', date('Y-m-d H:m:s',time()))->with('auctionHistory', 'company', 'images')->get();
        return view('backend.dashboard.auction.index', compact('auctionProducts'));
    }

    public function show($id){
        $auctionProduct = Product::where('id', $id)->where('auction_end', '>', date('Y-m-d H:m:s',time()))->with(['auctionHistory' => function($q){
            $q->orderByDesc('id')->with('company');
        }, 'company', 'images'])->first();
//        dd($auctionProducts);
        return view('backend.dashboard.auction.show', compact('auctionProduct'));
    }


}
