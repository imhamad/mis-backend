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
        $about_page = \App\Models\AboutPage::first();
        $about_page->image = url($about_page->image);

        $open_source_cultures_slider = \App\Models\OpenSourceCulture::where('status', 1)->get()->map(function ($item) {
            $item->icon = url($item->icon);
            return $item;
        });

        $our_current_clients = \App\Models\OurClient::where('status', 1)->where('type', 'current')
            ->select('name', 'logo', 'link')
            ->get()->map(function ($item) {
                $item->logo = url($item->logo);
                return $item;
            });

        $our_previous_clients = \App\Models\OurClient::where('status', 1)->where('type', 'previous')
            ->select('name', 'logo', 'link')
            ->get()->map(function ($item) {
                $item->logo = url($item->logo);
                return $item;
            });

        $our_team = \App\Models\OurTeamMember::get()->map(function ($item) {
            $item->image = url($item->image);
            return $item;
        });

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
        $service_page = \App\Models\ServicePage::first();
        $service_page->image = url($service_page->image);
        $service_page->services_process_image = url($service_page->services_process_image);

        $services = \App\Models\Service::get();
        
        $services = $services->map(function ($item) {
            $item->service_id = Str::slug($item->service_title);

            $value = [];
            foreach ($item->serviceDeliverableLists as $deliverable) {
                $value[] = $deliverable->bullet_point;
            }

            $item->deliverables_list = $value;

            $value = [];
            foreach($item->serviceDeliverableIcons as $icon) {
                $value[] = url($icon->icon);
            }

            $item->deliverables_icons = $value;

            unset($item->serviceDeliverableLists);
            unset($item->serviceDeliverableIcons);

            return $item;
        });

        $breadcrumb = [];
        foreach ($services as $service) {
            $breadcrumb[] = [
                'breadcrumb_title' => $service->breadcrumb_title,
                'service_id' => '#' . Str::slug($service->service_title),
            ];
        }

        return response()->json([
            'data' => $service_page,
            'breadcrumb' => $breadcrumb,
            'services' => $services,
        ]);
    }

    // caseStudyPage
    public function caseStudyPage()
    {
        $case_study_page = \App\Models\CaseStudyPage::first();
        $case_study_page->image = url($case_study_page->image);

        $tags = \App\Models\CaseStudy::select('tags')->get()->map(function ($item) {
            $tags = explode(',', $item->tags);
            $tags = array_map('trim', $tags);

            return $tags;
        })->flatten()->unique();

        return response()->json([
            'data' => $case_study_page,
            'tags' => $tags,
        ]);
    }

    // caseStudySearch
    public function caseStudySearch(Request $request)
    {
        $tags = explode(',', $request->tags);

        $case_studies = \App\Models\CaseStudy::select('id', 'title', 'case_study_image', 'tags', 'slug')
            ->when($request->tags, function ($query) use ($tags) {
                return $query->where(function ($query) use ($tags) {
                    foreach ($tags as $tag) {
                        $query->orWhere('tags', 'like', '%' . $tag . '%');
                    }
                });
            })
            ->where('title', 'like', '%' . $request->search . '%')
            ->get();

        $case_studies = $case_studies->map(function ($item) {
            $item->case_study_image = url($item->case_study_image);

            $tags = explode(',', $item->tags);
            $tags = array_map('trim', $tags);

            $item->tags = $tags;
            return $item;
        });

        return response()->json($case_studies);
    }

    // caseStudy
    public function caseStudy($slug)
    {
        $case_study = \App\Models\CaseStudy::where('slug', $slug)->first();
        $case_study->case_study_image = url($case_study->case_study_image);
        $case_study->image = url($case_study->image);
        $case_study->industry_of_client_image = url($case_study->industry_of_client_image);
        $case_study->client_image = url($case_study->client_image);

        $case_study->caseStudyServices->map(function ($item) {
            unset($item->case_study_id, $item->id);
            return $item;
        });

        $case_study->caseStudySliders->map(function ($item) {
            $item->image = url($item->image);
            unset($item->case_study_id, $item->id);
            return $item;
        });

        $tags = explode(',', $case_study->tags);
        $tags = array_map('trim', $tags);

        $case_study->tags = $tags;

        $related_case_studies = \App\Models\CaseStudy::select('id', 'title', 'case_study_image', 'tags', 'slug')
            ->where('id', '!=', $case_study->id)
            ->where('title', 'like', '%' . $case_study->title . '%')
            ->get();

        $related_case_studies = $related_case_studies->map(function ($item) {
            $item->case_study_image = url($item->case_study_image);

            $tags = explode(',', $item->tags);
            $tags = array_map('trim', $tags);

            $item->tags = $tags;
            return $item;
        });

        return response()->json([
            'data' => $case_study,
            'related_case_studies' => $related_case_studies,
        ]);
    }
}
