<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityGroup;
use Illuminate\Http\Request;
use App\Http\Resources\CityGroupResource;
use App\Http\Requests\CityGroup\CreateRequest;
use App\Http\Requests\CityGroup\UpdateRequest;

class CityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return CityGroupResource::collection(CityGroup::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
      $cityGroup = new CityGroup();
      $cityGroup->group = $request->group;
      $cityGroup->save();
      
      if( count($request->cities) ) {
        $cityGroup->cities()->saveMany(City::whereIn('id', $request->cities)->get());
      }

      return new CityGroupResource($cityGroup->load('cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CityGroup $cityGroup)
    {
      return new CityGroupResource($cityGroup->load(['cities','campaign']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CityGroup $cityGroup)
    {
      $cityGroup->group = $request->group;
      $cityGroup->save();

      if( count($request->cities) ) {
        $cityGroup->cities()->saveMany(City::whereIn('id', $request->cities)->get());
      }
      return new CityGroupResource($cityGroup->load('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityGroup $cityGroup)
    {
      $cityGroup->delete();
      return response()->noContent();
    }
}
