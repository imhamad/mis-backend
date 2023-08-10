<?php

namespace App\Http\Controllers\Admin;

use App\Models\SEOTag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SEOTagsController extends Controller
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
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($page_name)
    {
        $tag = SEOTag::where('page_name', $page_name)->first();

        if (!$tag) {
            return response()->json([
                'seo_title' => '',
                'seo_description' => '',
                'icon' => ''
            ], 200);
        }

        $tag->icon = url($tag->icon);

        return response()->json($tag, 200);
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
    public function update(Request $request, $page_name)
    {
        $image = '';
        if ($request->icon) {

            $iconData = $request->icon;
            $iconName = time() . '-' . Str::slug($page_name) . '.png';
            $iconDirectory = 'images';

            $image = saveBase64Image($iconData, $iconDirectory, $iconName);
        }
        // update or create
        $tag = SEOTag::updateOrCreate(
            ['page_name' => $page_name],
            [
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'icon' => $image
            ]
        );

        return response()->json([
            'msg' => 'SEO tag updated successfully.',
            'data' => $tag,
        ], 200);
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
