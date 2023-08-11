<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('service_title', 'LIKE', "%{$request->search}%")
            ->paginate(10);

        return response()->json($services, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'breadcrumb_title' => 'required',
            'service_title' => 'required',
            'service_first_paragraph' => 'required',
            'service_second_paragraph' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Service::create([
            'breadcrumb_title' => $request->breadcrumb_title,
            'service_title' => $request->service_title,
            'service_first_paragraph' => $request->service_first_paragraph,
            'service_second_paragraph' => $request->service_second_paragraph,
        ]);

        // $service_deliverable_icons = explode(',', $request->service_deliverable_icons);
        $service_deliverable_lists = explode(',', $request->service_deliverable_lists);

        // convert array to array of objects
        // $service_deliverable_icons = array_map(function ($item) {
        //     return ['icon' => $item];
        // }, $service_deliverable_icons);

        // convert array to array of objects
        $service_deliverable_lists = array_map(function ($item) {
            return ['bullet_point' => $item];
        }, $service_deliverable_lists);

        // $service->serviceDeliverableIcons()->createMany($service_deliverable_icons);
        $service->serviceDeliverableLists()->createMany($service_deliverable_lists);

        return response()->json([
            'msg' => 'Service created successfully.',
            'data' => $service,
        ], 201);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'msgErr' => 'Service not found.',
            ], 404);
        }

        return response()->json($service, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'breadcrumb_title' => 'required',
            'service_title' => 'required',
            'service_first_paragraph' => 'required',
            'service_second_paragraph' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'msgErr' => 'Service not found.',
            ], 404);
        }

        $service->update([
            'breadcrumb_title' => $request->breadcrumb_title ?? $service->breadcrumb_title,
            'service_title' => $request->service_title ?? $service->service_title,
            'service_first_paragraph' => $request->service_first_paragraph ?? $service->service_first_paragraph,
            'service_second_paragraph' => $request->service_second_paragraph ?? $service->service_second_paragraph,
        ]);

        return response()->json([
            'msg' => 'Service updated successfully.',
            'data' => $service,
        ], 201);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'msgErr' => 'Service not found.',
            ], 404);
        }

        $service->delete();

        return response()->json([
            'msg' => 'Service deleted successfully.',
        ], 200);
    }
}
