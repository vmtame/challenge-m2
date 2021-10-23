<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campaign\CreateRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return CampaignResource::collection(Campaign::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
      $campaign = new Campaign();
      $campaign->campaign = $request->campaign;
      $campaign->save();
      $update = [];

      foreach($request->products as $k => $product ) {
        $update[$product] = [ 'discount' => $request->discounts[$k] ];
      }

      $campaign->products()->sync($update);

      return new CampaignResource($campaign->load('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
      return new CampaignResource($campaign->load(['group', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Campaign $campaign)
    {
      $campaign->campaign = $request->campaign;
      $campaign->save();
      $update = [];

      foreach($request->products as $k => $product ) {
        $update[$product] = [ 'discount' => $request->discounts[$k] ];
      }

      $campaign->products()->sync($update);

      return new CampaignResource($campaign->load('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
      $campaign->delete();

      return response()->noContent();
    }
}
