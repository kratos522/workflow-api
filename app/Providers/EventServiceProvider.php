<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
     protected $listen = [
         'Brexis\LaravelWorkflow\Events\Leave' => [
             'App\Listeners\WorkflowSubscribers@onLeave',
         ],
         'Brexis\LaravelWorkflow\Events\Guard' => [
             'App\Listeners\WorkflowSubscribers@onGuard',
         ],
         'App\Events\taskBeforeB' => [
             'App\Listeners\TaskB',
         ],
         'App\Events\taskAfterB' => [
             'App\Listeners\TaskB',
         ],
     ];

     protected $subscribe = [
         'App\Listeners\WorkflowSubscribers',
         'App\Listeners\TaskB',
     ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
