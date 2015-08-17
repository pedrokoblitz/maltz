<?php

namespace Maltz\Calendar\Ctrl;

class Calendar
{
    public function route($app)
    {
        $app->post('/api/calendar', function() use ($app) {

        });
        
        $app->get('/api/event/:id', function() use ($app) {

        });
        
        $app->post('/api/event/save', function() use ($app) {

        });

        return $app;
    }
}