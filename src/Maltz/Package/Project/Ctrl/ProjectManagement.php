<?php

namespace Maltz\Package\Project\Ctrl;

use Maltz\Package\Project\Model\Project;
use Maltz\Package\Project\Model\Ticket;
use Maltz\Package\Project\Model\TimeTracking;
use Maltz\Package\Project\Model\Invoice;

class ProjectManagement
{
    /**
     * /
     * @param  [type] $app [description]
     * @return [type]      [description]
     */
    public function route($app)
    {
        $app->get('/api/project/:id/devs', function () use ($app) {
            
                $result = Project::query($app->db, 'getDevs', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_devs')->conditions(array('id' => '\d+'));

        $app->get('/api/project/:id/users', function () use ($app) {
            
                $result = Project::query($app->db, 'getUsers', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_users')->conditions(array('id' => '\d+'));

        $app->get('/api/project/:id/tickets', function () use ($app) {
        
                $result = Project::query($app->db, 'getTickets', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_tickets')->conditions(array('id' => '\d+'));

        $app->get('/api/project/:id/invoices', function () use ($app) {
        
                $result = Project::query($app->db, 'getInvoices', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_invoices')->conditions(array('id' => '\d+'));

        $app->get('/api/project/:id/hours', function () use ($app) {
        
                $result = Project::query($app->db, 'getBillableHours', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_hours')->conditions(array('id' => '\d+'));

        $app->get('/api/invoice(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
                $result = Invoice::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
        })->name('invoice_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get('/api/invoice/:id/show', function ($id) use ($app) {
        
                $result = Invoice::query($app->db, 'show', $id);
                $app->handler->handleApiResponse($result);
        })->name('invoice_show')->conditions(array('id' => '\d+'));

        $app->map('/api/invoice/delete', function () use ($app) {
        
                $record = $app->handler->handlePostRequest();
                $result = Invoice::query($app->db, 'delete', $id);
                $app->handler->handleApiResponse($result);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'invoice', $id, 'delete', '', '', $app->nonce->get());
        })->via('POST', 'DELETE')->name('invoice_delete');

        $app->get('/api/project/:id/invoice/create', function ($id) use ($app) {
        
                $result = Project::query($app->db, 'createInvoice', $id);
                $app->handler->handleApiResponse($result);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'project', $id, 'create_invoice', 'invoice', $result->getLastInsertId(), $app->nonce->get());
        })->name('project_create_invoice')->conditions(array('id' => '\d+'));

        $app->get('/api/project(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
                $result = Project::query($app->db, 'find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
        })->name('project_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get('/api/project/:id/show', function ($id) use ($app) {
        
                $result = Project::query($app->db, 'show', $id);
                $app->handler->handleApiResponse($result);
        })->name('project_show')->conditions(array('id' => '\d+'));

        $app->map('/api/project/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Project::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->getLastInsertId();
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'project', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('project_save');

        $app->map('/api/project/delete', function () use ($app) {
        
                $record = $app->handler->handlePostRequest();
                $result = Project::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'project', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'DELETE')->name('project_delete');

        $app->get('/api/track/:ticket_id/start', function ($ticket_id) use ($app) {
        
                $result = TimeTracking::query($app->db, 'start', $ticket_id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'time_started', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('track_start')->conditions(array('ticket_id' => '\d+'));

        $app->get('/api/track/:ticket_id/stop', function ($ticket_id) use ($app) {
        
                $result = TimeTracking::query($app->db, 'stop', $ticket_id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'time_stoped', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->name('track_stop')->conditions(array('ticket_id' => '\d+'));

        $app->get('/api/ticket/latest', function () use ($app) {

                $result = Ticket::query($app->db, 'find', 'modified');
                $app->handler->handleApiResponse($result);

        })->name('ticket_latest');

        $app->get('/api/ticket/list(/:pg', function ($pg = 1) use ($app) {

                $result = Ticket::query($app->db, 'findAll', $pg, $per_page);
                $app->handler->handleApiResponse($result);
        })->name('ticket_list');

        $app->map('/api/ticket/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->getLastInsertId();
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('ticket_save');

        $app->map('/api/ticket/priority', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'changePriority', $id, $priority);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'change_priority', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('ticket_change_priority');

        $app->map('/api/ticket/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'delete', $id);
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'DELETE')->name('ticket_delete');

        $app->get('/api/ticket/:id/dev', function ($id) use ($app) {

                $app->handler->handleApiResponse($result);
        })->name('ticket_dev')->conditions(array('id' => '\d+'));

        $app->map('/api/ticket/close', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $closed = Ticket::query($app->db, 'close', $record->get('id'));
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'close', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('ticket_close');

        $app->map('/api/ticket/comment', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $user_id = $app->sessionDataStore->getUserId();
                $result = Ticket::query($app->db, 'comment', $id, $user_id, $record->get('comment'));
                Log::query($app->db, 'log', $user_id, 'ticket', $id, 'close');
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('ticket_comment');

        $app->map('/api/ticket/call', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                Log::query($app->db, 'log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'close', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        })->via('POST', 'PUT')->name('ticket_request_call');

        return $app;
    }
}
