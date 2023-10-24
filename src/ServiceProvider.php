<?php

namespace Fixel\PurgeDoCdnCache;

use Illuminate\Support\Facades\Route;
use Statamic\Facades\Utility;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/cp.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon(): void
    {
        $this->registerCpRoutes(function () {
            Route::prefix('fixel/purge-do-cdn-cache')
                ->name('fixel.purge-do-cdn-cache.')
                ->group(function () {
                    Route::get('/cdns', [Controller::class, 'cdns'])->name('cdns');
                    Route::post('/cdns/{origin}/purge', [Controller::class, 'purge'])->name('purge');
                });
        });

        Utility::extend(function () {
            Utility::register('purge-do-cdn-cache')
                ->view('purge-do-cdn-cache::ui')
                ->title('Purge DigitalOcean CDN Cache')
                ->icon('sites');
        });
    }
}
