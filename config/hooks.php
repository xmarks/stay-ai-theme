<?php

return [
    'collectors' => [
        App\Hooks\HookCollectors\ACF::class,
        App\Hooks\HookCollectors\App::class,
        App\Hooks\HookCollectors\Blog::class,
        App\Hooks\HookCollectors\CaseStudy::class,
        App\Hooks\HookCollectors\Resource::class
    ],
];
