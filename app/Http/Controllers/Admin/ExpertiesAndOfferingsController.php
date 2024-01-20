<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpertiesAndOffering;
use Illuminate\Support\Facades\Validator;

class ExpertiesAndOfferingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        try {
            $expertiesAndOfferings = ExpertiesAndOffering::where('status', 1)
                ->where('title', 'LIKE', "%{$request->search}%")
                ->paginate(10)
                ->through(function ($expertiesAndOffering) {
                    // attach the image baseURL
                    $expertiesAndOffering->icon = baseURL($expertiesAndOffering->icon);

                    return $expertiesAndOffering;
                });

            return response()->json($expertiesAndOfferings, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
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
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'icon' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $image = '';
            if ($request->icon) {
                $image = imageUploader($request->icon, $request->title);
            }

            $expertiesAndOfferings = ExpertiesAndOffering::create([
                'title' => $request->title,
                'description' => $request->description,
                'icon' => $image,
            ]);

            return response()->json([
                'msg' => 'Experties and offering created successfully.',
                'data' => $expertiesAndOfferings,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
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
        try {
            $expertiesAndOffering = ExpertiesAndOffering::find($id);

            if (!$expertiesAndOffering) {
                return response()->json([
                    'msgErr' => 'Experties and offering not found.',
                ], 404);
            }

            // attach the image baseURL
            $expertiesAndOffering->icon = baseURL($expertiesAndOffering->icon);

            return response()->json($expertiesAndOffering, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $expertiesAndOfferings = ExpertiesAndOffering::find($id);

            if (!$expertiesAndOfferings) {
                return response()->json([
                    'msgErr' => 'Experties and offering not found.',
                ], 404);
            }

            // attach the image baseURL
            $expertiesAndOfferings->icon = baseURL($expertiesAndOfferings->icon);

            return response()->json($expertiesAndOfferings, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $expertiesAndOfferings = ExpertiesAndOffering::find($id);

            if (!$expertiesAndOfferings) {
                return response()->json([
                    'msgErr' => 'Experties and offering not found.',
                ], 404);
            }

            $image = $expertiesAndOfferings->icon;
            if ($request->icon) {
                $image = imageUploader($request->icon, $request->title);
            }

            if (!$expertiesAndOfferings) {
                return response()->json([
                    'msgErr' => 'Experties and offering not found.',
                ], 404);
            }

            $expertiesAndOfferings->title = $request->title;
            $expertiesAndOfferings->description = $request->description;
            $expertiesAndOfferings->icon = $image;
            $expertiesAndOfferings->save();

            return response()->json([
                'msg' => 'Experties and offering updated successfully.',
                'data' => $expertiesAndOfferings,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
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
        try {
            $expertiesAndOfferings = ExpertiesAndOffering::find($id);

            if (!$expertiesAndOfferings) {
                return response()->json([
                    'msgErr' => 'Experties and offering not found.',
                ], 404);
            }

            $expertiesAndOfferings->delete();

            return response()->json([
                'msg' => 'Experties and offering deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
