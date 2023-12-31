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
            ->paginate(10)->through(function ($service) {
                $service->image = baseURL($service->image);
                $service->service_icon = baseURL($service->service_icon);
                $service->client_image = baseURL($service->client_image);
                $service->process_image = baseURL($service->process_image);
                return $service;
            });

        return response()->json($services, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'seo_meta_tags' => 'required',
            'image' => 'required',
            'service_pre_title' => 'required',
            'service_title' => 'required',
            'service_description' => 'required',
            'service_icon' => 'required',
        ], []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service_image = $request->image ? imageUploader($request->image, 'service-image') : '';
        $service_icon = $request->service_icon ? imageUploader($request->service_icon, 'service-icon') : '';
        $client_image = $request->client_image ? imageUploader($request->client_image, 'client-image') : '';
        $process_image = $request->process_image ? imageUploader($request->process_image, 'process-image') : '';

        $service = Service::create([
            'seo_title' => $request->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags,
            'image' => $service_image,
            'service_pre_title' => $request->service_pre_title,
            'service_title' => $request->service_title,
            'service_description' => $request->service_description,
            'service_icon' => $service_icon,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $client_image,
            'keywords' => $request->keywords,
            'og_url' => $request->og_url,
            'process_image' => $process_image,
            'video' => $request->video,
            'menu_visibility' => $request->menu_visibility,
        ]);

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

        $service->image = $service->image ? baseURL($service->image) : '';
        $service->service_icon = $service->service_icon ? baseURL($service->service_icon) : '';
        $service->client_image = $service->client_image ? baseURL($service->client_image) : '';
        $service->process_image = $service->process_image ? baseURL($service->process_image) : '';

        return response()->json($service, 200);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'msgErr' => 'Service not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'seo_meta_tags' => 'required',
            'service_pre_title' => 'required',
            'service_title' => 'required',
            'service_description' => 'required',
        ], []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service_image = $request->image ? imageUploader($request->image, 'service-image') : $service->image;
        $service_icon = $request->service_icon ? imageUploader($request->service_icon, 'service-icon') : $service->service_icon;
        $client_image = $request->client_image ? imageUploader($request->client_image, 'client-image') : $service->client_image;
        $process_image = $request->process_image ? imageUploader($request->process_image, 'process-image') : $service->process_image;

        $service->update([
            'seo_title' => $request->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags,
            'image' => $service_image,
            'service_pre_title' => $request->service_pre_title,
            'service_title' => $request->service_title,
            'service_description' => $request->service_description,
            'service_icon' => $service_icon,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $client_image,
            'keywords' => $request->keywords,
            'og_url' => $request->og_url,
            'process_image' => $process_image,
            'video' => $request->video,
            'menu_visibility' => $request->menu_visibility,
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
