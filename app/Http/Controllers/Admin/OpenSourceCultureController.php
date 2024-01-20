<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OpenSourceCulture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OpenSourceCultureController extends Controller
{
    public function index(Request $request)
    {
        try {
            $opensourcecultures = OpenSourceCulture::where('status', 1)
                ->where('title', 'LIKE', "%{$request->search}%")
                ->paginate(10)
                ->through(function ($opensourceculture) {
                    // attach the image url
                    $opensourceculture->icon = baseURL($opensourceculture->icon);

                    return $opensourceculture;
                });

            return response()->json($opensourcecultures, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

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

            $opensourceculture = OpenSourceCulture::create([
                'title' => $request->title,
                'description' => $request->description,
                'icon' => $image,
            ]);

            return response()->json([
                'msg' => 'Open Source Culture created successfully.',
                'data' => $opensourceculture,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id)
    {
        try {
            $opensourceculture = OpenSourceCulture::find($id);

            if (!$opensourceculture) {
                return response()->json([
                    'msgErr' => 'Open Source Culture not found.',
                ], 404);
            }

            // attach the image url
            $opensourceculture->icon = baseURL($opensourceculture->icon);

            return response()->json($opensourceculture, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function edit($id)
    {
        try {
            $opensourceculture = OpenSourceCulture::find($id);

            if (!$opensourceculture) {
                return response()->json([
                    'msgErr' => 'Open Source Culture not found.',
                ], 404);
            }

            // attach the image url
            $opensourceculture->icon = baseURL($opensourceculture->icon);

            return response()->json($opensourceculture, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

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

            $image = null;
            if ($request->icon) {
                $image = imageUploader($request->icon, $request->title);
            }

            $opensourceculture = OpenSourceCulture::find($id);

            if (!$opensourceculture) {
                return response()->json([
                    'msgErr' => 'Open Source Culture not found.',
                ], 404);
            }

            $opensourceculture->update([
                'title' => $request->title,
                'description' => $request->description,
                'icon' => $image ? $image : $opensourceculture->icon,
            ]);

            return response()->json([
                'msg' => 'Open Source Culture updated successfully.',
                'data' => $opensourceculture,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id)
    {
        try {
            $opensourceculture = OpenSourceCulture::find($id);

            if (!$opensourceculture) {
                return response()->json([
                    'msgErr' => 'Open Source Culture not found.',
                ], 404);
            }

            $opensourceculture->delete();

            return response()->json([
                'msg' => 'Open Source Culture deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
