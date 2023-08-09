<?php

namespace App\Http\Middleware;

use App\Models\MuserToPlan;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next, ...$userTypes)
    {
        $user = $request->user();

        return $user;

        $plan = MuserToPlan::where('user_id', $user->id)->where('end_date', '>=', Carbon::now())->select('end_date')->first();

        // Check if the user has a valid plan
        if ($user && in_array($user->type, $userTypes) && $plan) {
            $endDate = Carbon::parse($user->end_date);
            $today = Carbon::today();

            // Check if the plan end date is greater than today's date
            if ($endDate->greaterThanOrEqualTo($today)) {
                $request->route()->setParameter('userType', $user->type);
                return $next($request);
            }
        }

        $request->route()->setParameter('userType', 'free');
        return $next($request);
    }
}
