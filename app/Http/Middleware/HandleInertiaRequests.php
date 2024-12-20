<?php

namespace App\Http\Middleware;

use App\Models\Leave;
use App\Models\Seafarer;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'applied' => [
                'count' => Seafarer::where('status', 'new')->count()
            ],
            'on_boarding' => [
                'count' => Seafarer::where('status', 'on_boarding')->count()
            ],
            'leave' => [
                'count' => Leave::where('status', 'pending')->count()
            ]
        ]);
    }
}
