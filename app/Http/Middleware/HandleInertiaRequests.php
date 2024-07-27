<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
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
        $user = $request->user()
        ? new UserResource($request->user()->load('roles.permissions'))
        : null;

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user,
            ],
            'toastMessage' => $this->getToastMessage(),
            'locale' => app()->getLocale(),
        ];
    }

    private function getToastMessage(): ?array
    {
        $toastMessage = null;

        foreach (['success', 'info', 'warning', 'error'] as $messageType) {
            if (session($messageType)) {
                $toastMessage = [
                    'type' => $messageType,
                    'message' => session($messageType),
                ];

                break;
            }
        }

        return $toastMessage;
    }
}
