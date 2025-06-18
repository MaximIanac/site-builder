<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MODULE STRUCTURE CONVENTION
    |--------------------------------------------------------------------------
    |
    | All modules MUST follow this structure:
    |
    | Services/Modules/
    |   ├── ModuleName/
    |       ├── ModuleNameModule.php          # Main module class
    |       ├── ModuleNameServiceProvider.php # Service provider
    |       ├── Data/                         # Data providers
    |       ├── Config/                       # Module-specific configs
    |       ├── Resources/                    # Views, lang files etc
    |       └── ...                           # Other module files
    |
    | When adding new module, register it in 'autoload' section below.
    */

    /*
    |--------------------------------------------------------------------------
    | MODULE AUTOLOADING
    |--------------------------------------------------------------------------
    |
    | Modules to be autoloaded by application.
    | Key format: lowercase module name
    | Value: module main class
    */
    'modules' => [
        'catalog' => [
            'class' => \Maximianac\SiteBuilder\Services\Modules\Catalog\CatalogModule::class,
            'components' => [
                'providers' => [
                    'data' => \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogDataProvider::class,
                    'service' => \Maximianac\SiteBuilder\Services\Modules\Catalog\CatalogServiceProvider::class
                ]
            ],
        ],
        'reviews' => [
            'class' => \Maximianac\SiteBuilder\Services\Modules\Reviews\ReviewsModule::class,
            'components' => [
                'providers' => [
                    'data' => \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Data\MCatalogDataProvider::class,
                    'service' => \Maximianac\SiteBuilder\Services\Modules\Reviews\ReviewsServiceProvider::class
                ]
            ],
        ],
    ],

    'modules_path' => 'Services/Modules',

    /*
    |--------------------------------------------------------------------------
    | MODULE RESOURCES
    |--------------------------------------------------------------------------
    |
    | Paths for module assets and publishable resources.
    | These will be auto-registered by service providers.
    */
//    'resources' => [
//        'views' => 'resources/views/modules',
//        'lang' => 'resources/lang/modules',
//        'assets' => 'public/modules',
//    ],

    /*
    |--------------------------------------------------------------------------
    | MODULE DEFAULT CONFIGURATION
    |--------------------------------------------------------------------------
    |
    | These values will be merged with module-specific configs
    | from Config/ directory of each module.
    */
    'defaults' => [
        'enabled' => true,
        'middleware' => ['web'],
        'route_prefix' => 'module',
        'cache_ttl' => 3600,
    ],

    'utils' => [
        'breadcrumbs' => \Maximianac\SiteBuilder\Services\Utils\Breadcrumb\Breadcrumbs::class
    ]
];
