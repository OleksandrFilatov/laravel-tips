<?php
/*
 * Copyright 2021 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace LaravelJsonApi\Laravel\Tests\Integration;

use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{

    /**
     * @inheritDoc
     */
    protected function getPackageProviders($app)
    {
        return [
            \LaravelJsonApi\Spec\ServiceProvider::class,
            \LaravelJsonApi\Validation\ServiceProvider::class,
            \LaravelJsonApi\Encoder\Neomerx\ServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    /**
     * Call the closure within the default Laravel API route setup.
     *
     * @param \Closure $callback
     * @return void
     * @see https://github.com/laravel/laravel/blob/8.x/app/Providers/RouteServiceProvider.php
     */
    protected function defaultApiRoutes(\Closure $callback): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group($callback);
    }

    /**
     * Call the closure within the default Laravel API route setup.
     *
     * @param \Closure $callback
     * @return void
     * @see https://github.com/laravel/laravel/blob/8.x/app/Providers/RouteServiceProvider.php
     */
    protected function defaultApiRoutesWithNamespace(\Closure $callback): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace('App\\Http\\Controllers')
            ->group($callback);
    }
}
