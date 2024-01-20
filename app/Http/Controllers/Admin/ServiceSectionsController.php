<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceSection;
use App\Http\Controllers\Controller;
use App\Models\ServiceDeliverableIcon;
use Illuminate\Support\Facades\Validator;

class ServiceSectionsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $serviceSections = ServiceSection::where('service_id', $request->service_id)
                ->paginate(10)->through(function ($serviceSection) {
                    $serviceSection->service_deliverable_lists = $serviceSection->serviceDeliverableListCommanSeparated();
                    $serviceSection->service_deliverable_icons = $serviceSection->serviceDeliverableIconsArray();

                    unset($serviceSection->serviceDeliverableLists, $serviceSection->serviceDeliverableIcons);

                    return $serviceSection;
                });

            return response()->json($serviceSections, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'service_id' => 'required',
                'breadcrumb_title' => 'required',
                'service_title' => 'required',
                'service_description' => 'required',
                'service_background_color' => 'required',
                'service_content_direction' => 'required',
            ], []);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $serviceSection = ServiceSection::create([
                'service_id' => $request->service_id,
                'breadcrumb_title' => $request->breadcrumb_title,
                'breadcrumb_slug' => Str::slug($request->breadcrumb_title),
                'service_title' => $request->service_title,
                'service_description' => $request->service_description,
                'service_background_color' => $request->service_background_color,
                'service_content_direction' => $request->service_content_direction,
            ]);

            $service_deliverable_lists = explode(',', $request->service_deliverable_lists);
            $service_deliverable_lists = array_map(function ($item) {
                return ['bullet_point' => $item];
            }, $service_deliverable_lists);

            $serviceSection->serviceDeliverableLists()->createMany($service_deliverable_lists);

            foreach ($request->service_deliverable_icons as $item) {
                ServiceDeliverableIcon::create([
                    'service_section_id' => $serviceSection->id,
                    'icon' => imageUploader($item, 'service-deliverable-icon')
                ]);
            }

            return response()->json([
                'msg' => 'Service section created successfully.',
                'data' => $serviceSection,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id)
    {
        try {
            $serviceSection = ServiceSection::with('serviceDeliverableIcons')->find($id);

            $serviceSection->deliverable_lists = $serviceSection->serviceDeliverableListCommanSeparated();
            $serviceSection->deliverable_icons = $serviceSection->serviceDeliverableIconsArray();

            unset($serviceSection->serviceDeliverableLists, $serviceSection->serviceDeliverableIcons);

            $serviceSection->service_deliverable_lists = $serviceSection->deliverable_lists;
            $serviceSection->service_deliverable_icons = $serviceSection->deliverable_icons;

            unset($serviceSection->deliverable_lists, $serviceSection->deliverable_icons);

            if (!$serviceSection) {
                return response()->json([
                    'msgErr' => 'Service not found.',
                ], 404);
            }

            return response()->json($serviceSection, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'breadcrumb_title' => 'required',
                'service_title' => 'required',
                'service_description' => 'required',
                'service_background_color' => 'required',
                'service_content_direction' => 'required',
            ], []);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $serviceSection = ServiceSection::find($id);

            if (!$serviceSection) {
                return response()->json([
                    'msgErr' => 'Service section not found.',
                ], 404);
            }

            $serviceSection->update([
                'breadcrumb_title' => $request->breadcrumb_title,
                'breadcrumb_slug' => Str::slug($request->breadcrumb_title),
                'service_title' => $request->service_title,
                'service_description' => $request->service_description,
                'service_background_color' => $request->service_background_color,
                'service_content_direction' => $request->service_content_direction,
            ]);

            $service_deliverable_lists = explode(',', $request->service_deliverable_lists);
            $service_deliverable_lists = array_map(function ($item) {
                return ['bullet_point' => $item];
            }, $service_deliverable_lists);

            $serviceSection->serviceDeliverableLists()->delete();
            $serviceSection->serviceDeliverableLists()->createMany($service_deliverable_lists);

            $serviceSection->serviceDeliverableIcons()->delete();
            foreach ($request->service_deliverable_icons as $item) {
                ServiceDeliverableIcon::create([
                    'service_id' => $serviceSection->id,
                    'service_section_id' => $serviceSection->id,
                    'icon' => imageUploader($item, 'service-deliverable-icon')
                ]);
            }

            return response()->json([
                'msg' => 'Service section updated successfully.',
                'data' => $serviceSection,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id)
    {
        try {
            $serviceSection = ServiceSection::find($id);

            if (!$serviceSection) {
                return response()->json([
                    'msgErr' => 'Service section not found.',
                ], 404);
            }

            $serviceSection->delete();

            return response()->json([
                'msg' => 'Service section deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
