<?php

namespace App\Http\Controllers\Admin;

use App\Models\OurTeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OurTeamMembersController extends Controller
{
    public function index(Request $request)
    {
        try {
            $teamMembers = OurTeamMember::where('name', 'LIKE', "%{$request->search}%")
                ->paginate(10)->through(function ($teamMember) {
                    // attach the image url
                    $teamMember->image = baseURL($teamMember->image);

                    return $teamMember;
                });

            return response()->json($teamMembers, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'designation' => 'required',
                'image' => 'required',
                'url' => 'url',
                'is_current' => 'boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $image = '';
            if ($request->image) {
                // You need to define your imageUploader function here
                $image = imageUploader($request->image, $request->name);
            }

            $teamMember = OurTeamMember::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'image' => $image,
                'url' => $request->url,
                'is_current' => $request->is_current ?? false,
            ]);

            return response()->json([
                'msg' => 'Team member created successfully.',
                'data' => $teamMember,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id)
    {
        try {
            $teamMember = OurTeamMember::find($id);

            $teamMember->image = baseURL($teamMember->image);

            if (!$teamMember) {
                return response()->json([
                    'msgErr' => 'Team member not found.',
                ], 404);
            }

            return response()->json($teamMember, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'designation' => 'string',
                'url' => 'url',
                'is_current' => 'boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $teamMember = OurTeamMember::find($id);

            if (!$teamMember) {
                return response()->json([
                    'msgErr' => 'Team member not found.',
                ], 404);
            }

            $image = $teamMember->image;
            if ($request->image) {
                // You need to define your imageUploader function here
                $image = imageUploader($request->image, $request->name);
            }

            $teamMember->update([
                'name' => $request->name ?? $teamMember->name,
                'designation' => $request->designation ?? $teamMember->designation,
                'image' => $image,
                'url' => $request->url ?? $teamMember->url,
                'is_current' => $request->is_current ?? $teamMember->is_current,
            ]);

            return response()->json([
                'msg' => 'Team member updated successfully.',
                'data' => $teamMember,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id)
    {
        try {
            $teamMember = OurTeamMember::find($id);

            if (!$teamMember) {
                return response()->json([
                    'msgErr' => 'Team member not found.',
                ], 404);
            }

            $teamMember->delete();

            return response()->json([
                'msg' => 'Team member deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
