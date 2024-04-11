<?php

return [

    'enabled' => env('ANALYTICS_ENABLED', true),

    /**
     * Analytics Dashboard.
     *
     * The prefix and middleware for the analytics dashboard.
     */
    'prefix' => 'admin/analytics',

    'middleware' => [
        'web',
        'permission:admin',
    ],

    /**
     * Exclude.
     *
     * The routes excluded from page view tracking.
     */
    'exclude' => [
        '/admin/*',
    ],

    /**
     * Determine if traffic from robots should be tracked.
     */
    'ignoreRobots' => false,

    /**
     * Ignored IP addresses.
     *
     * The IP addresses excluded from page view tracking.
     */
    'ignoredIPs' => [
        // '192.168.1.1',
    ],

    /**
     * Mask.
     *
     * Mask routes so they are tracked together.
     */
    'mask' => [
        // '/users/*',
    ],

    /**
     * Ignore methods.
     *
     * The HTTP verbs/methods that should be excluded from page view tracking.
     */
    'ignoreMethods' => [
        // 'OPTIONS', 'POST',
    ],

    'session' => [
        'provider' => \AndreasElia\Analytics\RequestSessionProvider::class,
    ],

];
