<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\BlogStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;

class FrontApisController extends Controller
{
    // homePage
    public function homePage()
    {
        $services = \App\Models\Service::inRandomOrder()->select('service_title', 'service_pre_title', 'service_description', 'service_icon', 'client_name', 'slug')->get()->map(function ($item) {
            // Convert the icon URL to an absolute URL using the "url" helper function
            $item->service_icon = url($item->service_icon);
            return $item;
        });

        // Retrieve the first record from the HomePage model
        $homePageData = \App\Models\HomePage::first();
        $homePageData->image = url($homePageData->image);  // Convert the image URL to an absolute URL using the "url" helper function

        // Return a JSON response with specific data
        return response()->json([
            'data' => $homePageData->only(['seo_title', 'seo_meta_tags', 'image', 'keywords', 'og_url']),  // Extract specified attributes from the $homePageData
            'countries' => $homePageData->getCountriesList(),  // Get a list of countries using the "getCountriesList" method
            'services' => $services,
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
    public function servicePage(Request $request, $slug)
    {
        $service = \App\Models\Service::where('slug', $slug)->first();

        if (!$service) {
            return response()->json(['msgErr' => 'Service not found'], 404);
        }

        $service->service_icon = url($service->service_icon);
        $service->image = url($service->image);
        $service->client_image = url($service->client_image);
        $service->process_image = url($service->process_image);

        $service_sections = \App\Models\ServiceSection::where('service_id', $service->id)->get()->map(function ($item) {
            $delivable_list = \App\Models\ServiceDeliverableList::where('service_section_id', $item->id)->get()->map(function ($item) {
                return $item->bullet_point;
            });

            $delivable_icons = \App\Models\ServiceDeliverableIcon::where('service_section_id', $item->id)->get()->map(function ($item) {
                return url($item->icon);
            });

            $item->deliverables_list = $delivable_list;
            $item->deliverables_icons = $delivable_icons;
            return $item;
        });

        $service->service_sections = $service_sections;

        $breadcrumb = [];
        foreach ($service_sections as $section) {
            $breadcrumb[] = [
                'breadcrumb_title' => $section->breadcrumb_title,
                'service_id' => '#' . Str::slug($section->breadcrumb_title),
            ];
        }

        $service->breadcrumb = $breadcrumb;

        return response()->json($service);

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

        // Return a JSON response with the processed data
        return response()->json([
            'data' => $case_study_page,
        ]);
    }


    // caseStudySearch
    // Case Study Search Endpoint
    public function caseStudySearch(Request $request)
    {
        // Extract tags from the request and create an array
        $categories = explode(',', $request->categories);

        // Retrieve case study data based on search and tag criteria
        $case_studies = \App\Models\CaseStudy::select('id', 'title', 'pre_title', 'case_study_image', 'slug', 'category_id', 'about_the_client', 'industry_of_client', 'client_name', 'client_designation', 'client_review', 'client_image')
            ->when($request->categories, function ($query, $categories) {
                return $query->whereIn('category_id', explode(',', $categories));
            })
            ->where('title', 'like', '%' . $request->search . '%')
            ->latest()
            ->limit(6)
            ->get();

        // Process and transform case study data
        $case_studies = $case_studies->map(function ($item) {
            // Convert image URLs to absolute URLs using the "url" helper function
            $item->case_study_image = url($item->case_study_image);

            $category = \App\Models\Category::find($item->category_id);
            $item->category = $category ? $category->title : '';
            $item->category_slug = $category ? $category->slug : '';

            unset($item->category_id);
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

            $item->name = $ourTeamMember->name ?? '';
            $item->designation = $ourTeamMember->designation ?? '';
            unset($item->case_study_id, $item->id, $item->member_id);
            return $item;
        });

        $category = \App\Models\Category::find($case_study->category_id);
        $case_study->category = $category ? $category->title : '';

        $case_study->project_credits = $case_study->caseStudyCredits;

        unset($case_study->project_credit, $case_study->caseStudyCredits, $case_study->category_id);

        // case study of clients
        $case_study->industry_of_client = explode(',', $case_study->industry_of_client);

        // Retrieve related case studies based on title similarity
        $related_case_studies = \App\Models\CaseStudy::select('id', 'title', 'case_study_image', 'tags', 'slug')
            ->where('id', '!=', $case_study->id)
            ->where('title', 'like', '%' . $case_study->title . '%')
            ->get();

        // Return a JSON response with the case study details and related data
        return response()->json([
            'data' => $case_study,
            // 'related_case_studies' => $related_case_studies,
        ]);
    }

    public function getTestimonials(Request $request)
    {
        $testimonials = \App\Models\Testimonial::when($request->count, function ($query, $count) use ($request) {
            return $query->limit($request->count);
        })
            ->get()->map(function ($item) {
                $item->image = url($item->image);
                return $item;
            });

        return response()->json($testimonials);
    }

    public function getRandomTestimonial(Request $request)
    {
        $testimonial = \App\Models\Testimonial::inRandomOrder()->first();
        $testimonial->image = url($testimonial->image);
        return response()->json($testimonial);
    }

    public function servicesDropdown()
    {
        $services = \App\Models\Service::select('service_pre_title', 'service_title', 'service_icon', 'id', 'service_icon', 'slug')->get()->map(function ($item) {
            $item->service_icon = url($item->service_icon);
            return $item;
        });

        return response()->json($services);
    }

    public function blogPage()
    {
        // Retrieve the first record from the BlogPage model or create one if not found
        $blog_page_data = \App\Models\BlogPage::first();

        // Convert the image URL to an absolute URL using the "url" helper function
        $blog_page_data->image = url($blog_page_data->image);

        // Return a JSON response with the processed data
        return response()->json($blog_page_data);
    }

    public function blogSearch(Request $request)
    {
        // Extract tags from the request and create an array
        $categories = explode(',', $request->categories);

        // Retrieve case study data based on search and tag criteria
        $blogs = \App\Models\Blog::select('id', 'title', 'description', 'slug', 'category_id', 'user_id', 'slug', 'status', 'summary', 'updated_at', 'image')
            ->when($request->categories, function ($query) use ($categories) {
                return $query->whereIn('category_id', $categories);
            })
            ->where('title', 'like', '%' . $request->search . '%')
            ->where('status', BlogStatus::PUBLISHED)
            ->latest()
            ->paginate(10);

        // Modify the paginated data
        $blogs->getCollection()->transform(function ($item) {
            $item->image = url($item->image);
            $item->powered_by_logo = url($item->powered_logo);
            $item->created_time = date('M d, D', strtotime($item->updated_at));
            $created_by = ($item->user ? $item->user->first_name : '') . ' ' . ($item->user ? $item->user->last_name : '');
            $item->created_by = $created_by;
            $item->category_title = $item->category->title ?? '';
            $item->category_slug = $item->category->slug ?? '';

            unset($item->category, $item->updated_at, $item->user);
            return $item;
        });

        return response()->json($blogs);
    }

    public function getBlog($slug)
    {
        $blog = \App\Models\Blog::onSlug($slug)->first();

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found',
            ]);
        }

        $blog->image = url($blog->image);
        $blog->powered_by_logo = url($blog->powered_by_logo);
        $blog->created_time = date('M d, D', strtotime($blog->updated_at));
        $created_by = $blog->user ? $blog->user->first_name : '';
        $created_by .= ' ' . ($blog->user ? $blog->user->last_name : '');
        $blog->created_by = $created_by;
        $blog->category_title = $blog->category->title ?? '';
        $blog->category_slug = $blog->category->slug ?? '';
        $blog->sponsor_logo = url($blog->sponsor_logo);

        $blog->related_blogs = \App\Models\Blog::where('category_id', $blog->category_id)->where('id', '!=', $blog->id)->limit(4)->get()->map(function ($item) {
            $item->image = url($item->image);
            $item->created_time = date('M d, D', strtotime($item->updated_at));
            $created_by = ($item->user ? $item->user->first_name : '') . ' ' . ($item->user ? $item->user->last_name : '');
            $item->created_by = $created_by;
            $item->category_title = $item->category->title ?? '';
            $item->category_slug = $item->category->slug ?? '';
            $item->powered_by_logo = url($item->powered_by_logo);

            unset($item->category, $item->user, $item->created_at, $item->updated_at);
            return $item;
        });

        $blog->author = [
            'full_name' => $blog->user->first_name . ' ' . $blog->user->last_name,
            'avatar' => url($blog->user->avatar),
            'linkedin_url' => $blog->user->linkedin_url,
            'description' => $blog->user->description ?? '',
            // contribution = user's more blogs
            'contirbution' => \App\Models\Blog::with('category')->where('user_id', $blog->user_id)->where('id', '!=', $blog->id)->limit(8)->get()->map(function ($item) {
                $item->category_title = $item->category->title ?? '';
                $item->category_slug = $item->category->slug ?? '';
                unset($item->category, $item->description);
                return $item;
            }),
        ];

        unset($blog->category, $blog->user, $blog->created_at, $blog->updated_at);

        return response()->json($blog);
    }
}
