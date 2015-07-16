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
        $app->get('/ticket(/:key)', function($key = 'modified') use ($app) {

        	$result = Ticket::query($app->db, 'find', $key);
        	$app->render('ticket.list.form.tpl.php');

        })->name('ticket_list');

        $app->get('/ticket/list(/:pg(/:per_page))', function($pg = 1, $per_page = 20) use ($app) {

        	$result = Ticket::query($app->db, 'findAll', $pg, $per_page);
        	$app->render('ticket.list.form.tpl.php');

        })->name('ticket_list_all');

        $app->get('/ticket/add', function() use ($app) {

        	$app->render('ticket.add.form.tpl.php');

        })->name('ticket_form');

        $app->get('/ticket/:id/edit', function($id) use ($app) {

        	$result = Ticket::query($app->db, 'show', $id);
        	$app->render('ticket.edit.form.tpl.php');

        })->name('ticket_form')->conditions(array('id' => '\d+'));

        $app->get('/ticket/:id/priority/:priority/change', function($id, $priority) use ($app) {

        	$result = Ticket::query($app->db, 'changePriority', $id, $priority);

        })->name('ticket_change_priority')->conditions(array('id' => '\d+', 'priority' => '\d+'));

        $app->get('/ticket/:id/delete', function($id) use ($app) {

        	$result = Ticket::query($app->db, 'delete', $id);

        })->name('ticket_delete')->conditions(array('id' => '\d+'));


        $app->get('/ticket/:id/close', function($id) use ($app) {

        	$closed = Ticket::query($app->db, 'close', $id);

        })->name('ticket_delete')->conditions(array('id' => '\d+'));

		return $app;
	}
}