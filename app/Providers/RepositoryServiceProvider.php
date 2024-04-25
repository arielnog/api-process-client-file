<?php

namespace App\Providers;

use App\Repositories\AnnouncementRepository;
use App\Repositories\ContentRepository;
use App\Repositories\Contracts\IAnnouncementRepository;
use App\Repositories\Contracts\IContentRepository;
use App\Repositories\Contracts\IFileControlRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Contracts\IVehicleRepository;
use App\Repositories\FileControlRepository;
use App\Repositories\UserRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            IFileControlRepository::class,
            FileControlRepository::class
        );

        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );

        $this->app->bind(
            IContentRepository::class,
            ContentRepository::class
        );
    }
}
