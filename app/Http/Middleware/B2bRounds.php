<?php

namespace App\Http\Middleware;

use App\Models\B2bApplication;
use App\Models\Round;
use Closure;
use Illuminate\Http\Request;

class B2bRounds
{
    public function handle(Request $request, Closure $next)
    {
        $shouldRedirect = false;
        $message = null;

        if ($request->round->status === Round::DRAFT || $request->round->to <= now()) {
            $shouldRedirect = true;
            $message = 'This B2B round is now closed';
        }

        if ($request->round->applications()->where('user_id', auth()->id())->count() && $request->routeIs('rounds.service-providers.create')) {
            $shouldRedirect = true;
            $message = 'This profile has already applied';
        }

        if ($request->routeIs('rounds.service-providers.create') && $request->round->applications()->count() >= $request->round->max_applicants) {
            $shouldRedirect = true;
            $message = 'The maximum number of applicants has been reached for this round';
        }

        return $shouldRedirect ? redirect(route('home'))->with('success', $message) : $next($request);
    }
}
