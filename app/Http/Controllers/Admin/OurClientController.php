<?php

namespace App\Http\Controllers\Admin;

use App\Models\OurClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OurClientController extends Controller
{
    public function index(Request $request)
    {
        $ourclients = OurClient::where('name', 'LIKE', "%{$request->search}%")
            ->when($request->type, function ($query) use ($request) {
                return $query->where('type', $request->type);
            })
            ->paginate(10)
            ->through(function ($ourclient) {
                // attach the image url
                $ourclient->logo = url($ourclient->logo);

                return $ourclient;
            });

        return response()->json($ourclients, 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required|url',
            'logo' => 'required',
            'type' => 'required|in:client,partner,current,previous',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = '';
        if ($request->logo)
            $image = imageUploader($request->logo, $request->name);

        $ourclient = OurClient::create([
            'name' => $request->name,
            'link' => $request->link,
            'logo' => $image,
            'type' => $request->type,
        ]);

        return response()->json([
            'msg' => 'Client created successfully.',
            'data' => $ourclient,
        ], 201);
    }

    public function show($id)
    {
        $client = OurClient::find($id);

        if (!$client) {
            return response()->json([
                'msgErr' => 'Client not found.',
            ], 404);
        }

        // attach the image url
        $client->logo = url($client->logo);

        return response()->json($client, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'link' => 'url',
            'type' => 'in:client,partner,current,previous',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ourclient = OurClient::find($id);

        if (!$ourclient) {
            return response()->json([
                'msgErr' => 'Client not found.',
            ], 404);
        }

        $image = $ourclient->logo;
        if ($request->logo)
            $image = imageUploader($request->logo, $request->name);

        $ourclient->update([
            'name' => $request->name ? $request->name : $ourclient->name,
            'link' => $request->link ? $request->link : $ourclient->link,
            'logo' => $image,
        ]);

        return response()->json([
            'msg' => 'Client updated successfully.',
            'data' => $ourclient,
        ], 201);
    }

    public function destroy($id)
    {
        $ourclient = OurClient::find($id);

        if (!$ourclient) {
            return response()->json([
                'msgErr' => 'Client not found.',
            ], 404);
        }

        $ourclient->delete();

        return response()->json([
            'msg' => 'Client deleted successfully.',
        ], 200);
    }
}
