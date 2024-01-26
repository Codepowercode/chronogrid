<?php

namespace App\Http\Controllers\backend;

use App\Exports\InvoicesExport;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Subscription\CreateRequest;
use App\Http\Requests\Backend\Subscription\EditRequest;
use App\Jobs\AccessSendMailJob;
use App\Models\Product;
use App\Models\Subscription;
use App\MyHellepr\Hellper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('backend.dashboard.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.dashboard.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();
            $subscription = new Subscription();
            $subscription->name = $request->name;
            $subscription->year = $request->year;
            $subscription->price = $request->price;
            $subscription->sale = $request->sale;
            $subscription->save();
        DB::commit();
        return redirect()->route('subscription.index')->with('success', 'Success added');
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
        $subscription =  Subscription::findOrFail($id);
        return view('backend.dashboard.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, $id)
    {
        DB::beginTransaction();
        $subscription =  Subscription::findOrFail($id);
        $subscription->name = $request->name;
        $subscription->year = $request->year;
        $subscription->price = $request->price;
        $subscription->sale = $request->sale;
        $subscription->save();
        DB::commit();
        return redirect()->route('subscription.index')->with('success', 'Success updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $subscription =  Subscription::findOrFail($id);
        $subscription->delete();
        return redirect()->route('subscription.index')->with('success', 'Success deleted');
    }
}
