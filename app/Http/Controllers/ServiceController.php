<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // Show all services
    public function index(Request $request)
    {
        $serviceTypes = \App\Models\Service::SERVICE_TYPES;
        $selectedType = $request->query('service_type');
        $query = Service::query();
        if ($selectedType && array_key_exists($selectedType, $serviceTypes)) {
            $query->where('service_type', $selectedType);
        }
        $services = $query->orderBy('created_at', 'desc')->get();
        return view('services.index', compact('services', 'serviceTypes', 'selectedType'));
    }

    // Show form to create a new service
    public function create()
    {
        $serviceTypes = \App\Models\Service::SERVICE_TYPES;
        return view('services.create', compact('serviceTypes'));
    }

    // Store new service in database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string|in:' . implode(',', \App\Models\Service::getServiceTypeKeys()),
            'media.*' => 'mimes:jpeg,png,jpg,gif,bmp,webp,mp4,avi,mov,wmv,flv,webm,mkv|max:102400',
        ]);

        $service = Service::create($request->only('title', 'description', 'service_type'));

        if ($request->hasFile('media')) {
            $files = $request->file('media');
            if (count($files) > 5) {
                return back()->withErrors(['media' => 'You can upload up to 5 files only.']);
            }
            foreach ($files as $file) {
                $path = $file->store('services', 'public');
                $service->media()->create(['file' => $path]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    // Show form to edit service
    public function edit(Service $service)
    {
        $service->load('media');
        $serviceTypes = \App\Models\Service::SERVICE_TYPES;
        return view('services.edit', compact('service', 'serviceTypes'));
    }

    // Update the service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|string|in:' . implode(',', \App\Models\Service::getServiceTypeKeys()),
            'media.*' => 'mimes:jpeg,png,jpg,gif,bmp,webp,mp4,avi,mov,wmv,flv,webm,mkv|max:102400',
        ]);

        $service->update($request->only('title', 'description', 'service_type'));

        $deleteMediaIds = explode(',', $request->input('delete_media_ids', ''));

        if (!empty($deleteMediaIds)) {
            foreach ($deleteMediaIds as $mediaId) {
                $media = $service->media()->find($mediaId);
                if ($media) {
                    // Delete file from storage
                    \Storage::disk('public')->delete($media->file);
                    // Delete from DB
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('media')) {
            $existingCount = $service->media()->count();
            $files = $request->file('media');
            if (($existingCount + count($files)) > 5) {
                return back()->withErrors(['media' => 'You can upload up to 5 files only.']);
            }
            foreach ($files as $file) {
                $path = $file->store('services', 'public');
                $service->media()->create(['file' => $path]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Delete service
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }

}
