<?php
include(__DIR__.'/common.php');

#$channel->queue_declare('main-hello', false, false, false, false);
echo ' [*] Waiting for messages. To exit press CTRL+C'.PHP_EOL;

$callback = function($msg) {
	echo " [x] '", $msg->body, "', at ".date('r')."\n";
	sleep(3); // Simulate intensive processing going on
	$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('main-hello-persistent', '', false, false, false, false, $callback);
while(count($channel->callbacks)) {
	$channel->wait();
}

