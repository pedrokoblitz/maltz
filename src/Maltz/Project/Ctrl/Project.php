<?php

namespace Maltz\Project\Ctrl;

use Maltz\Project\Model\Project;
use Maltz\Project\Model\Ticket;
use Maltz\Project\Model\TimeTracking;
use Maltz\Project\Model\Invoice;


class Project
{
    public function route($app)
    {
        $app->get('/project/:id/devs', function() use ($app) {
            
            $result = Project::query('getDevs', $id);
            $app->handler->handleApiResponse($result);

        })->name('project_devs')->conditions(array('id' => '\d+'));

        $app->get('project/:id/users', function() use ($app) {
            
            $result = Project::query('getUsers', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('project_users')->conditions(array('id' => '\d+'));

        $app->get('project/:id/tickets', function() use ($app) {
        
            $result = Project::query('getTickets', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('project_tickets')->conditions(array('id' => '\d+'));

        $app->get('project/:id/invoices', function() use ($app) {
        
            $result = Project::query('getInvoices', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('project_invoices')->conditions(array('id' => '\d+'));

        $app->get('project/:id/hours', function() use ($app) {
        
            $result = Project::query('getBillableHours', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('project_hours')->conditions(array('id' => '\d+'));

        $app->get('/invoice(/:pg(/:key(/:order)))', function($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
            $result = Invoice::query('find', $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);
        
        })->name('invoice_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get('/invoice/:id/show', function($id) use ($app) {
        
            $result = Invoice::query('show', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('invoice_show')->conditions(array('id' => '\d+'));

        $app->get('/invoice/:id/delete', function($id) use ($app) {
        
            $result = Invoice::query('delete', $id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'invoice', $id, 'delete');
        
        })->name('invoice_delete')->conditions(array('id' => '\d+'));

        $app->get('/project/:id/invoice/create', function($id) use ($app) {
        
            $result = Project::query('createInvoice', $id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'project', $id, 'create_invoice');
        
        })->name('project_create_invoice')->conditions(array('id' => '\d+'));

        $app->get('/project(/:pg(/:key(/:order)))', function($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
            $result = Project::query('find', $pg, $app->config('per_page'), $key, $order);
            $app->handler->handleApiResponse($result);
        
        })->name('project_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get('/project/:id/show', function($id) use ($app) {
        
            $result = Project::query('show', $id);
            $app->handler->handleApiResponse($result);
        
        })->name('project_show')->conditions(array('id' => '\d+'));

        $app->post('/project/:id/save', function($id) use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Project::query('save', $record);
            $app->handler->handleApiResponse($result);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            Log::query('log', $app->session->get('user.id'), 'project', $id, 'save');
        
        })->name('project_save')->conditions(array('id' => '\d+'));

        $app->get('/project/:id/delete', function($id) use ($app) {
        
            $result = Project::query('delete', $id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'project', $id, 'delete');
        
        })->name('project_delete')->conditions(array('id' => '\d+'));

        $app->get('/track/:ticket_id/start', function($ticket_id) use ($app) {
        
            $result = TimeTracking::query('start', $ticket_id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'time_started');
        
        })->name('track_start')->conditions(array('ticket_id' => '\d+'));

        $app->get('/track/:ticket_id/stop', function($ticket_id) use ($app) {
        
            $result = TimeTracking::query('stop', $ticket_id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'time_stoped');
        
        })->name('track_stop')->conditions(array('ticket_id' => '\d+'));

        $app->get('/ticket/latest', function() use ($app) {

        	$result = Ticket::query($app->db, 'find', 'modified');
            $app->handler->handleApiResponse($result);

        })->name('ticket_latest');

        $app->get('/ticket/list(/:pg', function($pg = 1) use ($app) {

        	$result = Ticket::query($app->db, 'findAll', $pg, $per_page);
            $app->handler->handleApiResponse($result);

        })->name('ticket_list');

        $app->post('/ticket/save', function() use ($app) {

            $record = $app->handler->handlePostRequest();
            $result = Ticket::query($app->db, 'save', $record);
            $app->handler->handleApiResponse($result);
            $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'save');

        })->name('ticket_save');

        $app->get('/ticket/:id/priority/:priority/change', function($id, $priority) use ($app) {

        	$result = Ticket::query($app->db, 'changePriority', $id, $priority);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'change_priority');

        })->name('ticket_change_priority')->conditions(array('id' => '\d+', 'priority' => '\d+'));

        $app->get('/ticket/:id/delete', function($id) use ($app) {

            $result = Ticket::query($app->db, 'delete', $id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'delete');

        })->name('ticket_delete')->conditions(array('id' => '\d+'));

        $app->get('/ticket/:id/dev', function($id) use ($app) {

            $app->handler->handleApiResponse($result);

        })->name('ticket_dev')->conditions(array('id' => '\d+'));

        $app->get('/ticket/:id/close', function($id) use ($app) {

        	$closed = Ticket::query($app->db, 'close', $id);
            $app->handler->handleApiResponse($result);
            Log::query('log', $app->session->get('user.id'), 'ticket', $id, 'close');

        })->name('ticket_close')->conditions(array('id' => '\d+'));

		return $app;
	}
}