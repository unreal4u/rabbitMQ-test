<?php

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class rabbitmqWrapper {
	private $_connection = null;
	protected $_channel = null;

	public function __construct() {
		$this->_connection = new AMQPConnection(HOST, PORT, USER, PASS);
		$this->_channel = $this->_connection->channel();
	}

	public function __destruct() {
		$this->_channel->close();
		$this->_connection->close();
	}

	public function sendMessage($queueId, $value) {
		$this->_channel->queue_declare($queueId, false, true, false, false);
		$message = new AMQPMessage($value, [
			'delivery_mode' => 2,
		]);

		$this->_channel->basic_publish($message, '', $queueId);
		return $message->body;
	}
}
