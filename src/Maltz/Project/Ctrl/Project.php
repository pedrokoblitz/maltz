<?php

namespace Maltz\Project\Ctrl;

use Maltz\Project\Model\Project;
use Maltz\Project\Model\Ticket;
use Maltz\Project\Model\TimeTracking;
use Maltz\Project\Model\Invoice;

class ProjectManagement
{
    public function route($app)
    {
        $app->get(
            '/project/:id/devs', function () use ($app) {
            
                $result = Project::query('getDevs', $id);
                $app->handler->handleApiResponse($result);

            }
        )->name('project_devs')->conditions(array('id' => '\d+'));

        $app->get(
            'project/:id/users', function () use ($app) {
            
                $result = Project::query('getUsers', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_users')->conditions(array('id' => '\d+'));

        $app->get(
            'project/:id/tickets', function () use ($app) {
        
                $result = Project::query('getTickets', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_tickets')->conditions(array('id' => '\d+'));

        $app->get(
            'project/:id/invoices', function () use ($app) {
        
                $result = Project::query('getInvoices', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_invoices')->conditions(array('id' => '\d+'));

        $app->get(
            'project/:id/hours', function () use ($app) {
        
                $result = Project::query('getBillableHours', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_hours')->conditions(array('id' => '\d+'));

        $app->get(
            '/invoice(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
                $result = Invoice::query('find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('invoice_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get(
            '/invoice/:id/show', function ($id) use ($app) {
        
                $result = Invoice::query('show', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('invoice_show')->conditions(array('id' => '\d+'));

        $app->post(
            '/invoice/delete', function () use ($app) {
        
                $record = $app->handler->handlePostRequest();
                $result = Invoice::query('delete', $id);
                $app->handler->handleApiResponse($result);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'invoice', $id, 'delete', '', '', $app->nonce->get());
        
            }
        )->name('invoice_delete');

        $app->get(
            '/project/:id/invoice/create', function ($id) use ($app) {
        
                $result = Project::query('createInvoice', $id);
                $app->handler->handleApiResponse($result);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'project', $id, 'create_invoice', '', '', $app->nonce->get());
        
            }
        )->name('project_create_invoice')->conditions(array('id' => '\d+'));

        $app->get(
            '/project(/:pg(/:key(/:order)))', function ($pg = 1, $key = 'title', $order = 'asc') use ($app) {
        
                $result = Project::query('find', $pg, $app->config('per_page'), $key, $order);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_list')->conditions(array('pg' => '\d+', 'key' => '\w+', 'order' => '\w+'));

        $app->get(
            '/project/:id/show', function ($id) use ($app) {
        
                $result = Project::query('show', $id);
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_show')->conditions(array('id' => '\d+'));

        $app->post(
            '/project/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Project::query('save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                // Log::query('log', $app->sessionDataStore->getUserId(), 'project', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_save');

        $app->post(
            '/project/delete', function () use ($app) {
        
                $record = $app->handler->handlePostRequest();
                $result = Project::query('delete', $id);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'project', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        
            }
        )->name('project_delete');

        $app->get(
            '/track/:ticket_id/start', function ($ticket_id) use ($app) {
        
                $result = TimeTracking::query('start', $ticket_id);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'time_started', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        
            }
        )->name('track_start')->conditions(array('ticket_id' => '\d+'));

        $app->get(
            '/track/:ticket_id/stop', function ($ticket_id) use ($app) {
        
                $result = TimeTracking::query('stop', $ticket_id);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'time_stoped', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);
        
            }
        )->name('track_stop')->conditions(array('ticket_id' => '\d+'));

        $app->get(
            '/ticket/latest', function () use ($app) {

                $result = Ticket::query($app->db, 'find', 'modified');
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_latest');

        $app->get(
            '/ticket/list(/:pg', function ($pg = 1) use ($app) {

                $result = Ticket::query($app->db, 'findAll', $pg, $per_page);
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_list');

        $app->post(
            '/ticket/save', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'save', $record);
                $id = $record->has('id') ? $record->get('id') : $result->get('last.insert.id');
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'save', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_save');

        $app->post(
            '/ticket/priority', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'changePriority', $id, $priority);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'change_priority', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_change_priority');

        $app->post(
            '/ticket/delete', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $result = Ticket::query($app->db, 'delete', $id);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'delete', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_delete');

        $app->get(
            '/ticket/:id/dev', function ($id) use ($app) {

                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_dev')->conditions(array('id' => '\d+'));

        $app->post(
            '/ticket/close', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $closed = Ticket::query($app->db, 'close', $id);
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'close', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_close');

        $app->post(
            '/ticket/comment', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                $user_id = $app->sessionDataStore->getUserId();
                $result = Ticket::query('comment', $id, $user_id, $record->get('comment'));
                // Log::query('log', $user_id, 'ticket', $id, 'close');
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_comment');

        $app->post(
            '/ticket/call', function () use ($app) {

                $record = $app->handler->handlePostRequest();
                // Log::query('log', $app->sessionDataStore->getUserId(), 'ticket', $id, 'close', '', '', $app->nonce->get());
                $app->handler->handleApiResponse($result);

            }
        )->name('ticket_request_call');

        return $app;
    }
}
