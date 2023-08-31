<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontApisController extends Controller
{
    // homePage
    public function homePage()
    {
        // Retrieve expertise and offerings data with status as 1, in random order, and limit the result to 6
        $experties = \App\Models\ExpertiesAndOffering::where('status', 1)->inRandomOrder()->limit(6)->get()->map(function ($item) {
            // Convert the icon URL to an absolute URL using the "url" helper function
            $item->icon = url($item->icon);
            return $item;
        });

        // Retrieve the first record from the HomePage model
        $homePageData = \App\Models\HomePage::first();
        $homePageData->image = url($homePageData->image);  // Convert the image URL to an absolute URL using the "url" helper function

        // Return a JSON response with specific data
        return response()->json([
            'data' => $homePageData->only(['seo_title', 'seo_meta_tags', 'image']),  // Extract specified attributes from the $homePageData
            'countries' => $homePageData->getCountriesList(),  // Get a list of countries using the "getCountriesList" method
            'experties_offerings' => $experties,  // Send the prepared $experties data
        ]);
    }

    // aboutPage
    public function aboutPage()
    {
        // Retrieve the first record from the AboutPage model
        $about_page = \App\Models\AboutPage::first();

        // Convert the image URL to an absolute URL using the "url" helper function
        $about_page->image = url($about_page->image);

        // Retrieve open source cultures data with status as 1
        $open_source_cultures_slider = \App\Models\OpenSourceCulture::where('status', 1)->get()->map(function ($item) {
            // Convert the icon URL to an absolute URL using the "url" helper function
            $item->icon = url($item->icon);
            return $item;
        });

        // Retrieve our current clients data with status as 1 and type as 'current'
        $our_current_clients = \App\Models\OurClient::where('status', 1)->where('type', 'current')
            ->select('name', 'logo', 'link')
            ->get()->map(function ($item) {
                // Convert the logo URL to an absolute URL using the "url" helper function
                $item->logo = url($item->logo);
                return $item;
            });

        // Retrieve our previous clients data with status as 1 and type as 'previous'
        $our_previous_clients = \App\Models\OurClient::where('status', 1)->where('type', 'previous')
            ->select('name', 'logo', 'link')
            ->get()->map(function ($item) {
                // Convert the logo URL to an absolute URL using the "url" helper function
                $item->logo = url($item->logo);
                return $item;
            });

        // Retrieve our team members data
        $our_team = \App\Models\OurTeamMember::get()->map(function ($item) {
            // Convert the image URL to an absolute URL using the "url" helper function
            $item->image = url($item->image);
            return $item;
        });

        // Return a JSON response with the retrieved and processed data
        return response()->json([
            'data' => $about_page,
            'open_source_cultures_slider' => $open_source_cultures_slider,
            'our_current_clients' => $our_current_clients,
            'our_previous_clients' => $our_previous_clients,
            'our_team' => $our_team,
        ]);
    }


    // servicePage
    public function servicePage()
    {
        // Retrieve the first record from the ServicePage model
        $service_page = \App\Models\ServicePage::first();

        // Convert image URLs to absolute URLs using the "url" helper function
        $service_page->image = url($service_page->image);
        $service_page->services_process_image = url($service_page->services_process_image);

        // Retrieve services data from the Service model
        $services = \App\Models\Service::get();

        // Process and transform the services data
        $services = $services->map(function ($item) {
            // Create a slugified version of the service title for the service_id
            $item->service_id = Str::slug($item->service_title);

            $value = [];
            foreach ($item->serviceDeliverableLists as $deliverable) {
                $value[] = $deliverable->bullet_point;
            }
            // Assign the deliverables list to the service object
            $item->deliverables_list = $value;

            $value = [];
            foreach ($item->serviceDeliverableIcons as $icon) {
                $value[] = url($icon->icon);
            }
            // Assign the deliverables icons to the service object
            $item->deliverables_icons = $value;

            // Unset the nested properties to avoid unnecessary data in the JSON response
            unset($item->serviceDeliverableLists);
            unset($item->serviceDeliverableIcons);

            return $item;
        });

        // Create breadcrumb data based on the services
        $breadcrumb = [];
        foreach ($services as $service) {
            $breadcrumb[] = [
                'breadcrumb_title' => $service->breadcrumb_title,
                'service_id' => '#' . Str::slug($service->service_title),
            ];
        }

        // Return a JSON response with the processed data
        return response()->json([
            'data' => $service_page,
            'breadcrumb' => $breadcrumb,
            'services' => $services,
        ]);
    }


    // caseStudyPage
    public function caseStudyPage()
    {
        // Retrieve the first record from the CaseStudyPage model
        $case_study_page = \App\Models\CaseStudyPage::first();

        // Convert the image URL to an absolute URL using the "url" helper function
        $case_study_page->image = url($case_study_page->image);

        // Retrieve tags from CaseStudy models and process them
        $tags = \App\Models\CaseStudy::select('tags')->get()->map(function ($item) {
            // Explode the comma-separated tags into an array
            $tags = explode(',', $item->tags);
            // Trim each tag to remove any extra whitespace
            $tags = array_map('trim', $tags);

            return $tags;
        })->flatten()->unique();

        // Return a JSON response with the processed data
        return response()->json([
            'data' => $case_study_page,
            'tags' => $tags,
        ]);
    }


    // caseStudySearch
    // Case Study Search Endpoint
    public function caseStudySearch(Request $request)
    {
        // Extract tags from the request and create an array
        $tags = explode(',', $request->tags);

        // Retrieve case study data based on search and tag criteria
        $case_studies = \App\Models\CaseStudy::select('id', 'title', 'case_study_image', 'tags', 'slug')
            ->when($request->tags, function ($query) use ($tags) {
                return $query->where(function ($query) use ($tags) {
                    foreach ($tags as $tag) {
                        $query->orWhere('tags', 'like', '%' . $tag . '%');
                    }
                });
            })
            ->where('title', 'like', '%' . $request->search . '%')
            ->latest()
            ->limit(6)
            ->get();

        // Process and transform case study data
        $case_studies = $case_studies->map(function ($item) {
            // Convert image URLs to absolute URLs using the "url" helper function
            $item->case_study_image = url($item->case_study_image);

            // Process and format tags
            $tags = explode(',', $item->tags);
            $tags = array_map('trim', $tags);

            $item->tags = $tags;
            return $item;
        });

        // Return a JSON response with the processed case study data
        return response()->json($case_studies);
    }

    // Case Study Details Endpoint
    public function caseStudy($slug)
    {
        // Retrieve case study data based on the provided slug
        $case_study = \App\Models\CaseStudy::where('slug', $slug)->first();

        // Convert image URLs to absolute URLs using the "url" helper function
        $case_study->case_study_image = url($case_study->case_study_image);
        $case_study->image = url($case_study->image);
        $case_study->industry_of_client_image = url($case_study->industry_of_client_image);
        $case_study->client_image = url($case_study->client_image);

        // Process and transform related data
        $case_study->caseStudyServices->map(function ($item) {
            unset($item->case_study_id, $item->id);
            return $item;
        });

        $case_study->caseStudySliders->map(function ($item) {
            $item->image = url($item->image);
            unset($item->case_study_id, $item->id);
            return $item;
        });

        // retrieve case study credits
        $case_study->caseStudyCredits->map(function ($item) {
            $ourTeamMember = \App\Models\OurTeamMember::find($item->member_id);

            $item->name = $ourTeamMember->name;
            $item->designation = $ourTeamMember->designation;
            unset($item->case_study_id, $item->id, $item->member_id);
            return $item;
        });

        // Process and format tags
        $tags = explode(',', $case_study->tags);
        $tags = array_map('trim', $tags);

        $case_study->tags = $tags;

        // Retrieve related case studies based on title similarity
        $related_case_studies = \App\Models\CaseStudy::select('id', 'title', 'case_study_image', 'tags', 'slug')
            ->where('id', '!=', $case_study->id)
            ->where('title', 'like', '%' . $case_study->title . '%')
            ->get();

        // Process and transform related case study data
        $related_case_studies = $related_case_studies->map(function ($item) {
            $item->case_study_image = url($item->case_study_image);

            $tags = explode(',', $item->tags);
            $tags = array_map('trim', $tags);

            $item->tags = $tags;
            return $item;
        });

        // Return a JSON response with the case study details and related data
        return response()->json([
            'data' => $case_study,
            'related_case_studies' => $related_case_studies,
        ]);
    }
}
