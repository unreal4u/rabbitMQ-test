<?php

require_once __DIR__.'/../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

define('HOST', '192.168.0.15');
define('PORT', 5672);
define('USER', 'main');
define('PASS', 'main');
define('VHOST', '/');

//If this is enabled you can see AMQP output on the CLI
#define('AMQP_DEBUG', true);

date_default_timezone_set('UTC');

$connection = new AMQPConnection(HOST, PORT, USER, PASS);
$channel = $connection->channel();
