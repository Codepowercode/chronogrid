<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\ListingService;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    protected $listingService;


    public function __construct()
    {
        $this->listingService = app(ListingService::class);
    }


    public function getListings(Request $request){
        return response()->json(
            $this->listingService->getListings($request->all())
        );

    }

    public function getListingFilterType(Request $request)
    {
        return response()->json(
            $this->listingService->getListingFilterType($request->all())
        );

    }

    public function getListingById($id)
    {
        return response()->json(
            $this->listingService->getListingById($id)
        );

    }
}
