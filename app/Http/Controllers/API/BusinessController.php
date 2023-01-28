<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;

// Requests
use App\Http\Requests\API\Businesses\StoreRequest;

// Model
use App\Models\Business;

// Resources
use App\Http\Resources\BusinessResource;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $business = Business::create([
                'name' => $request->input('name'),
                'alias' => SlugService::createSlug(Business::class, 'alias', $request->input('name')),
                'phone' => $request->input('phone'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'price' => $request->input('price'),
                'address' => [
                    'address1' => $request->input('address1'),
                    'address2' => $request->input('address2'),
                    'address3' => $request->input('address3'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'zip_code' => $request->input('zip_code'),
                ]
            ]);

            $business->transactions()->attach($request->input('transactions'));
            $business->categories()->attach($request->input('category'));
            $business->operationals()->createMany($request->input('operational'));

            //Upload Photo dan setup array untuk masuk ke database
            // Proses upload photo
            if ($request->hasFile('photos')) {
                $arrPhotos = [];
                foreach ($request->file('photos') as $key => $photo) {
                    $arrPhotos[$key]['name'] = $photo->getClientOriginalName();
                    $arrPhotos[$key]['path'] = $photo->store('/businesses', 'public');
                }

                $business->photos()->createMany($arrPhotos);
            }

            $business->load(['transactions', 'categories', 'operationals', 'photos']);

            DB::commit();
            return $this->responseSuccess(200, 'Business successfully created!', new BusinessResource($business));
        } catch (\Exception $ex) {
            DB::rollBack();
            report($ex);
            return $this->responseFailed(500, $ex->getMessage());
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $business = Business::findData($id)->first();
        if(!$business)
            return $this->responseFailed(404, 'Data not found!');

        try {
            DB::beginTransaction();
            $business->update([
                'name' => $request->input('name'),
                'alias' => SlugService::createSlug(Business::class, 'alias', $request->input('name')),
                'phone' => $request->input('phone'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'price' => $request->input('price'),
                'address' => [
                    'address1' => $request->input('address1'),
                    'address2' => $request->input('address2'),
                    'address3' => $request->input('address3'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'country' => $request->input('country'),
                    'zip_code' => $request->input('zip_code'),
                ]
            ]);

            $business->transactions()->sync($request->input('transactions'));
            $business->categories()->sync($request->input('category'));
            $business->operationals()->delete();
            $business->operationals()->createMany($request->input('operational'));

            //Upload Photo dan setup array untuk masuk ke database
            // Proses upload photo
            if ($request->hasFile('photos')) {
                $arrPhotos = [];
                foreach ($request->file('photos') as $key => $photo) {
                    $arrPhotos[$key]['name'] = $photo->getClientOriginalName();
                    $arrPhotos[$key]['path'] = $photo->store('/businesses', 'public');
                }

                $business->photos()->createMany($arrPhotos);
            }

            DB::commit();
            return $this->responseSuccess(200, 'Business successfully updated!', new BusinessResource($business));
        } catch (\Exception $ex) {
            DB::rollBack();
            report($ex);
            return $this->responseFailed(500, $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
