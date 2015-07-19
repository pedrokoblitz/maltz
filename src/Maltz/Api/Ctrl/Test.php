<?php

namespace Maltz\Api\Ctrl;

class Test
{
    public function route($app)
    {
        $app->get('/test', function () {
            $faker = \Faker\Factory::create();

            $headers = array('Accept' => 'application/json');

            $postUrls = array(
                'http://localhost/api/content/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'lang' => 'pt-br',
                    'date_pub' => $faker->datetime('now'),
                    'title' => $faker->sentence($nb = 3),
                    'subtitle' => $faker->sentence($nb = 3),
                    'excerpt' => $faker->text($maxNbChars = 200),
                    'description' => $faker->text($maxNbChars = 500),
                    'body' => $faker->text($maxNbChars = 1000),
                    'activity' => '1',
                    ),
                'http://localhost/api/collection/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'lang' => 'pt-br',
                    'title' => $faker->sentence($nb = 3),
                    'description' => $faker->text($maxNbChars = 200),
                    'activity' => '1',
                    ),
                'http://localhost/api/term/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'lang' => 'pt-br',
                    'title' => $faker->sentence($nb = 3),
                    'description' => $faker->text($maxNbChars = 200),
                    'activity' => '1',
                    ),
                'http://localhost/api/resource/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'filepath' => '/tmp',
                    'filename' => '13b73edae8443990be1aa8f1a483bc27',
                    'extension' => $faker->fileExtension,
                    'mimetype' => $faker->mimeType,
                    'url' => 'http://google.com',
                    'embed' => $faker->text($maxNbChars = 200),
                    'lang' => 'pt-br',
                    'title' => $faker->sentence($nb = 3),
                    'description' => $faker->text($maxNbChars = 200),
                    'activity' => '1',
                    ),
                'http://localhost/api/user/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'username' => $faker->userName,
                    'email' => $faker->email,
                    'first_name' => $faker->name,
                    'middle_name' => $faker->name,
                    'last_name' => $faker->name,
                    'password' => $faker->password,
                    'activity' => '1',
                    ),
                'http://localhost/api/config' => array(
                    'id' => $faker->randomDigitNotNull,
                    'key' => $faker->word,
                    'value' => $faker->sentence($nb = 1),
                    'format' => '1',
                    'activity' => '1',
                    ),
                'http://localhost/api/log' => array(
                    'user_id' => '1',
                    'group_name' => 'teste',
                    'group_id' => '1',
                    'item_name' => 'teste',
                    'item_id' => '1',
                    'action' => 'teste',
                    ),
                'http://localhost/api/type/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'item_name' => 'term',
                    'name' => 'section',
                    ),
                'http://localhost/api/role/save' => array(
                    'id' => $faker->randomDigitNotNull,
                    'name' => 'admin',
                    )
                );

            foreach ($postUrls as $url => $data) {
                $request = \Requests::post($url, $headers, $data);
                echo $url . ': ' . $request->status_code . "\n\n";
                print_r(json_decode($request->body));
                echo "\n\n";

                unset($data['id']);

                $request = \Requests::post($url, $headers, $data);
                echo $url . ' (no id this time): ' . $request->status_code . "\n\n";
                echo $request->status_code;
                var_dump($request->body);
                echo "\n\n";
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
/*
            foreach ($getUrls as $url) {
                $request = \Requests::get($url, $headers);
                echo $url . ': ' . $request->status_code . "\n\n";
                print_r(json_decode($request->body));
                echo "\n\n";
            }
*/
        });

        return $app;
    }
}
