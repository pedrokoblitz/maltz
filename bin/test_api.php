<?php

require dirname(__FILE__).'/../vendor/autoload.php';

$base = 'http://localhost/api/';

$response = \Requests::get($base . 'nonce');
$res = json_decode($response->body, true);

// CONTENT SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    'subtitle' => 'teacsstando',
    'excerpt' => 'testando',
    'description' => 'testando',
    'body' => '',
    'parent_id' => 0,
    'type_id' => 1,
    'date_pub' => date("Y-m-d H:i:s"),
    'language' => 'pt-br',
    'nonce' => $res['nonce'],
    );
$options = array(
    'timeout' => 20,
);
$response = \Requests::post($base . 'content/save', array(), $data, $options);

echo $response->body;

// COLLECTION SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    'description' => 'testando',
    'parent_id' => 0,
    'type_id' => 1,
    'language' => 'pt-br',
    'nonce' => $res['nonce'],
    );
$options = array(
    'timeout' => 20,
);
$response = \Requests::post($base . 'collection/save', array(), $data, $options);

echo $response->body;

// RESOURCE SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    'description' => 'testando',
    'type_id' => 1,
    'filepath' => 'public/media/',
    'filename' => 'teste',
    'extension' => 'jpg',
    'url' => '',
    'embed' => '',
    'language' => 'pt-br',
    'mimetype' => 'image/jpg',
    'nonce' => $res['nonce'],
    );
$options = array(
    'timeout' => 20,
);
$response = \Requests::post($base . 'resource/save', array(), $data, $options);

echo $response->body;

// TERM SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    'parent_id' => 0,
    'type_id' => 1,
    'language' => 'pt-br',
    'nonce' => $res['nonce'],
    );
$options = array(
    'timeout' => 20,
);
$response = \Requests::post($base . 'term/save', array(), $data, $options);

echo $response->body;

// ATTACHMENT SAVE
$data = array(
    'group_id' => 34,
    'item_id' => 36,
    'group_name' => 'content',
    'item_name' => 'content',
    'order' => 1,
    'nonce' => $res['nonce'],
    );
$response = \Requests::post($base . 'attachment/add', array(), $data);

echo $response->body;

// METADATA SAVE
$data = array(
    'item_name' => 'content',
    'item_id' => 4,
    'key' => 't',
    'value' => 'test',
    'order' => 1,
    );
$response = \Requests::post($base . 'metadata/add', $data);

echo $response->body;

// AREA SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . 'area/save', $data);

echo $response->body;

// BLOCK SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . 'block/save', $data);

echo $response->body;

// AREA ADD BLOCK
$data = array(
    );
$response = \Requests::post($base . 'area/block/add', $data);

echo $response->body;


// TYPE SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . 'type/save', $data);

echo $response->body;

// USER SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . 'user/save', $data);

echo $response->body;

// CONFIG SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . 'config', $data);

echo $response->body;

// NEW TICKET
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . '', $data);

echo $response->body;

// CHANGE TICKET PRIORITY
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . '', $data);

echo $response->body;

// CLOSE TICKET
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . '', $data);

echo $response->body;

// REQUEST TICKET CALL
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . '', $data);

echo $response->body;

// PROJECT SAVE
$data = array(
    'id' => 1,
    'title' => 'testado teste',
    );
$response = \Requests::post($base . '', $data);

echo $response->body;

