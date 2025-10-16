
protected $middlewareGroups = [
    // ...
    'api' => [
        LaravelSanctumHttpMiddlewareEnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        IlluminateRoutingMiddlewareSubstituteBindings::class,
    ],
];