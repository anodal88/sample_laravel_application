<?php

namespace App\Providers;

use App\OrderLine;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        /*
         * Registerind event to update calculable fields of OrderLines and Order
         * the "saving" is used because it is fired when a model is created or updateed
         * */
        OrderLine::saving(function($line)
        {
           $line->calculateTotals();
        });
        /*To update order total*/
        OrderLine::saved(function($line){
            $order = $line->order;
            $order->updateTotal();
            $order->save();
        });
        /*When remove an orderLine update the total of the order*/
        OrderLine::deleted(function($line){
            $order = $line->order;
            $order->updateTotal();
            $order->save();
        });
    }



}
