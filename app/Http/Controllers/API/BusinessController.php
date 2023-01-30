<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;

// Requests
use App\Http\Requests\API\Businesses\StoreRequest;
use App\Http\Requests\API\Businesses\UpdateRequest;
use App\Http\Requests\API\Businesses\SearchRequest;

// Model
use App\Models\Business;
use App\Models\BusinessOperational;
use App\Models\BusinessPhoto;

// Resources
use App\Http\Resources\BusinessResource;
use App\Http\Resources\BusinessCollection;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $businesses = Business::where(function($q) use ($request){
            if($request->has('price')){
                $q->where(function($q2) use($request){
                    foreach($request->input('price') as $key => $value){
                        if($key == 0)
                            $q2->where('price', $value);
                        else
                            $q2->orWhere('price', $value);
                    }
                });
            }

            if($request->has('categories')){
                $q->whereHas('categories', function($q2) use($request){
                    foreach($request->input('categories') as $key => $value){
                        if($key == 0)
                            $q2->where('alias', $value);
                        else
                            $q2->orWhere('alias', $value);
                    }
                });
            }
        });

        if($request->has('limit'))
            $businesses->limit($request->input('limit'));

        if($request->has('offset'))
            $businesses->offset($request->input('offset'));

        if($request->has('sort_by'))
            $businesses->orderBy($request->input('sort_by'), $request->input('sort_type'));

        return new BusinessCollection($businesses->get());
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
    public function update(UpdateRequest $request, $id)
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
            
            // Get All Business Operational id
            $currentOperationals = $business->operationals;
            $arrCurrentOperationalIds = $currentOperationals->pluck('id');
            $arrRequestedOperationalIds = array_column($request->input('operational'), 'id');

            // Get array ID yang perlu dihapus dari database
            $arrDeleteOperationalIds = array_diff($arrCurrentOperationalIds->all(), $arrRequestedOperationalIds);
            if(!empty($arrDeleteOperationalIds)){
                BusinessOperational::whereIn('id', $arrDeleteOperationalIds)->delete();
            }

            // Update Business Operational
            foreach($request->input('operational') as $key => $item){
                if($item['id'] == 0){       // Create
                    $business->operationals()->create($item);
                }else{                      // Update
                    $operational = BusinessOperational::find($item['id']);
                    $operational->update($item);
                }
            }

            // Get All Business Operational id
            $currentPhotos = $business->photos;
            $arrCurrentPhotoIds = $currentPhotos->pluck('id');
            $arrRequestedPhotoIds = $request->input('photos');

            // Get array ID yang perlu dihapus dari database
            $arrDeletePhotoIds = array_diff($arrCurrentPhotoIds->all(), $arrRequestedPhotoIds);
            if(!empty($arrDeletePhotoIds)){
                $deletePhotos = BusinessPhoto::whereIn('id', $arrDeletePhotoIds)->get();

                foreach($deletePhotos as $key => $item){
                    \Storage::delete($item->path);
                    $item->delete();
                }                
            }

            // //Upload Photo dan setup array untuk masuk ke database
            // // Proses upload photo
            if ($request->hasFile('new_photos')) {
                $arrPhotos = [];
                foreach ($request->file('new_photos') as $key => $photo) {
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
        $business = Business::findData($id)->first();
        if($business){
            try{
                DB::beginTransaction();
                
                $photos = $business->photos;
                foreach($photos as $key => $item){
                    \Storage::delete($item->path);
                }

                $business->delete();
                DB::commit();
                return $this->responseSuccess(200, 'Business successfully deleted!');
            }catch(\Exception $e){
                DB::rollBack();
                report($e);
                return $this->responseFailed(500, $e->getMessage());
            }
        }else{
            return $this->responseFailed(404, 'Data Not Found!');
        }            
    }
}
