<?php

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

include(__DIR__.'/common.php');
include(__DIR__.'/rabbitmqWrapper.php');

$rabbitmq = new rabbitmqWrapper();

for ($i = 0; $i < 5; $i++) {
	$sent = $rabbitmq->sendMessage('main-hello-persistent', 'Hello Camilo, lets make this more interesting! It is now: '.date('r').'; uniqid: '.uniqid());
	echo " [x] Sent '".$sent."'".PHP_EOL;
	sleep(1);
}

