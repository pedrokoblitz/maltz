<?php

namespace Maltz\Api\Ctrl;

class Test
{
    public function route($app)
    {
        $app->get('/test', function () {
            $headers = array('Accept' => 'application/json');

            $postUrls = array(
                'http://localhost/api/content/save' => array(
                    'id' => '1',
                    'lang' => 'pt-br',
                    'date_pub' => '',
                    'slug' => 'test-slug-0',
                    'title' => 'test-title',
                    'subtitle' => '',
                    'excerpt' => '',
                    'description' => '',
                    'body' => '',
                    'activity' => '1',
                    ),
                'http://localhost/api/collection/save' => array(
                    'id' => '1',
                    'lang' => 'pt-br',
                    'slug' => 'test-slug-0',
                    'title' => 'test-title',
                    'description' => '',
                    'activity' => '1',
                    ),
                'http://localhost/api/term/save' => array(
                    'id' => '1',
                    'lang' => 'pt-br',
                    'slug' => 'test-slug-0',
                    'title' => 'test-title',
                    'description' => '',
                    'activity' => '1',
                    ),
                'http://localhost/api/resource/save' => array(
                    'id' => '1',
                    'filepath' => '/dir',
                    'filename' => 'file',
                    'extension' => 'txt',
                    'mimetype' => 'text/txt',
                    'url' => 'http://google.com',
                    'embed' => '<code>....</code>',
                    'lang' => 'pt-br',
                    'slug' => 'test-slug-0',
                    'title' => 'test-title',
                    'description' => '',
                    'activity' => '1',
                    ),
                'http://localhost/api/user/save' => array(
                    'id' => '1',
                    'username' => 'admin',
                    'email' => 'pedrokoblitz@gmail.com',
                    'first_name' => 'Pedro',
                    'middle_name' => 'O. Bello',
                    'last_name' => 'Koblitz',
                    'password' => '',
                    'activity' => '1',
                    ),
                'http://localhost/api/config' => array(
                    'id' => '1',
                    'key' => 'content_per_page',
                    'value' => '12',
                    'format' => 'txt',
                    'activity' => '1',
                    ),
                'http://localhost/api/log' => array(
                    'id' => '1',
                    'user_id' => '1',
                    'group_name' => 'content',
                    'group_id' => '1',
                    'item_name' => 'resource',
                    'item_id' => '1',
                    'action' => 'add_attachment',
                    ),
                'http://localhost/api/type/save' => array(
                    'id' => '1',
                    'item_name' => '',
                    'name' => '',
                    ),
                'http://localhost/api/role/save' => array(
                    'id' => '1',
                    'name' => '',
                    )
                );

            foreach ($postUrls as $url => $data) {
                $request = \Requests::post($url, $headers, $data);
                echo $url . ': ' . $request->status_code . "\n";
                print_r(json_decode($request->body));

                unset($data['id']);

                $request = \Requests::post($url, $headers, $data);
                echo $url . ' (no id this time): ' . $request->status_code . "\n";
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
                echo $url . ': ' . $request->status_code . "\n";
                print_r(json_decode($request->body));
            }

        });

        return $app;
    }
}
