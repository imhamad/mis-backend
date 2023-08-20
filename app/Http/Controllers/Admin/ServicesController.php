<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceDeliverableIcon;
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
            'description' => 'required',
            'background_color' => 'required',
            'direction' => 'required|in:ltr,rtl',
        ], [
            'direction.in' => 'Direction must be ltr or rtl.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Service::create([
            'breadcrumb_title' => $request->breadcrumb_title,
            'service_title' => $request->service_title,
            'description' => $request->description,
            'background_color' => $request->background_color,
            'direction' => $request->direction,
        ]);

        $service_deliverable_lists = explode(',', $request->service_deliverable_lists);


        // convert array to array of objects
        $service_deliverable_lists = array_map(function ($item) {
            return ['bullet_point' => $item];
        }, $service_deliverable_lists);
        $service->serviceDeliverableLists()->createMany($service_deliverable_lists);

        foreach ($request->service_deliverable_icons as $item) {
            ServiceDeliverableIcon::create([
                'service_id' => $service->id,
                'icon' => imageUploader($item, 'service-deliverable-icon')
            ]);
        }

        return response()->json([
            'msg' => 'Service created successfully.',
            'data' => $service,
        ], 201);
    }

    public function show($id)
    {
        $service = Service::with('serviceDeliverableIcons')->find($id);

        $service->deliverable_lists = $service->serviceDeliverableListCommanSeparated();
        $service->deliverable_icons = $service->serviceDeliverableIconsArray();

        unset($service->serviceDeliverableLists, $service->serviceDeliverableIcons);

        $service->service_deliverable_lists = $service->deliverable_lists;
        $service->service_deliverable_icons = $service->deliverable_icons;

        unset($service->deliverable_lists, $service->deliverable_icons);

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
            'description' => 'required',
            'background_color' => 'required',
            'direction' => 'required|in:ltr,rtl',
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
            'description' => $request->description ?? $service->description,
            'background_color' => $request->background_color ?? $service->background_color,
            'direction' => $request->direction ?? $service->direction,
        ]);

        if ($request->service_deliverable_lists) {
            $service_deliverable_lists = explode(',', $request->service_deliverable_lists);

            // convert array to array of objects
            $service_deliverable_lists = array_map(function ($item) {
                return ['bullet_point' => $item];
            }, $service_deliverable_lists);

            $service->serviceDeliverableLists()->delete();
            $service->serviceDeliverableLists()->createMany($service_deliverable_lists);
        }

        if ($request->service_deliverable_icons) {
            $service->serviceDeliverableIcons()->delete();

            foreach ($request->service_deliverable_icons as $item) {
                ServiceDeliverableIcon::create([
                    'service_id' => $service->id,
                    'icon' => imageUploader($item, 'service-deliverable-icon')
                ]);
            }
        }

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
