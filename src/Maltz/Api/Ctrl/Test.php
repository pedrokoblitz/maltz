<?php

namespace Maltz\Api\Ctrl;

class Test
{
	public function route($app)
	{
		$app->get('/test/', function() {
			$headers = array('Accept' => 'application/json');

			$postUrls = array(
				'http://localhost/api/content/save' => array(
					'id' => '',
					'lang' => '',
					'date_pub' => '',
					'slug' => '',
					'title' => '',
					'subtitle' => '',
					'excerpt' => '',
					'description' => '',
					'body' => '',
					'activity' => '',
					),
				'http://localhost/api/collection/save' => array(
					'id' => '',
					'lang' => '',
					'slug' => '',
					'title' => '',
					'description' => '',
					'activity' => '',
					),
				'http://localhost/api/term/save' => array(
					'id' => '',
					'lang' => '',
					'slug' => '',
					'title' => '',
					'description' => '',
					'activity' => '',
					),
				'http://localhost/api/resource/save' => array(
					'id' => '',
					'filepath' => '',
					'filename' => '',
					'extension' => '',
					'mimetype' => '',
					'url' => '',
					'embed' => '',
					'lang' => '',
					'slug' => '',
					'title' => '',
					'description' => '',
					'activity' => '',
					),
				'http://localhost/api/user/save' => array(
					'id' => '',
					'username' => '',
					'email' => '',
					'first_name' => '',
					'middle_name' => '',
					'last_name' => '',
					'password' => '',
					'activity' => '',
					),
				'http://localhost/api/config' => array(
					'id' => '',
					'key' => '',
					'value' => '',
					'format' => '',
					'activity' => '',
					),
				'http://localhost/api/log' => array(
					'id' => '',
					'user_id' => '',
					'group_name' => '',
					'group_id' => '',
					'item_name' => '',
					'item_id' => '',
					'action' => '',
					),
				'http://localhost/api/type/save' => array(
					'id' => '',
					'item_name' => '',
					'name' => '',
					),
				'http://localhost/api/role/save' => array(
					'id' => '',
					'name' => '',
					)
				);

			foreach ($getUrls as $url => $data) {
				$request = \Requests::post($url, $headers, $data);
				echo $request->status_code;
				print_r(json_decode($request->body));

				unset($data['id']);

				$request = \Requests::post($url, $headers, $data);
				echo $request->status_code;
				print_r(json_decode($request->body));
			}

			$getUrls = array(
				'http://localhost/api/content/page',
				'http://localhost/api/content/1/show',
				'http://localhost/api/content/1/delete',
				'http://localhost/api/collection/album',
				'http://localhost/api/collection/1/show',
				'http://localhost/api/collection/1/delete',
				'http://localhost/api/term/section',
				'http://localhost/api/term/1/show',
				'http://localhost/api/term/1/delete',
				'http://localhost/api/resource/image',
				'http://localhost/api/resource/1/show',
				'http://localhost/api/resource/1/delete',
				'http://localhost/api/user',
				'http://localhost/api/user/1/show',
				'http://localhost/api/user/1/delete',
				'http://localhost/api/config',
				'http://localhost/api/config/1/show',
				'http://localhost/api/config/1/delete',
				'http://localhost/api/log',
				'http://localhost/api/log/1/show',
				'http://localhost/api/log/1/delete',
				'http://localhost/api/type',
				'http://localhost/api/type/1/show',
				'http://localhost/api/type/1/delete',
				'http://localhost/api/role',
				'http://localhost/api/role/1/show',
				'http://localhost/api/role/1/delete',
				'http://localhost/api/area',
				'http://localhost/api/area/1/show',
				'http://localhost/api/area/1/delete',
				'http://localhost/api/block',
				'http://localhost/api/block/1/show',
				'http://localhost/api/block/1/delete',
				);

			foreach ($getUrls as $url) {
				$request = \Requests::get($url, $headers);
				echo $request->status_code;
				print_r(json_decode($request->body));
			}

		});

		return $app;
	}
}