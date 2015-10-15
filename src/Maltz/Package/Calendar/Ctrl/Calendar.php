<?php

namespace Maltz\Package\Calendar\Ctrl;

class Calendar
{
    /**
     * /
     * @param  [type] $app [description]
     * @return [type]      [description]
     */
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