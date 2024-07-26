<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {

        $campaigns = Campaign::paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $products = Product::active()->get();
        return view('admin.campaigns.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required',
        ]);

        Campaign::create([
            'campaign_price' =>$request->campaign_price,
            'campaign_end_time' =>$request->campaign_end_time,
            'product_id' =>$request->product_id,
            'az'=>[
                'title'=>$request->az_title,
            ],
            'en'=>[
                'title'=>$request->en_title,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
            ]
        ]);

        return redirect()->route('campaigns.index')->with('message','Campaign added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        $products = Product::active()->get();
        return view('admin.campaigns.edit', compact('campaign','products'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Campaign $campaign)
    {

        $request->validate([
            'az_title'=>'required',
            'en_title'=>'required',
            'ru_title'=>'required'
        ]);

        $campaign->update( [
            'product_id' =>$request->product_id,
            'campaign_price' =>$request->campaign_price,
            'campaign_end_time' =>$request->campaign_end_time,
            'is_active' =>$request->is_active,
            'az'=>[
                'title'=>$request->az_title,
                'description'=>$request->az_description,
            ],
            'en'=>[
                'title'=>$request->en_title,
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'title'=>$request->ru_title,
                'description'=>$request->ru_description,
            ]

        ]);

        return redirect()->back()->with('message','Campaign updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {

        $campaign->delete();

        return redirect()->route('campaigns.index')->with('message', 'Campaign deleted successfully');

    }
}
