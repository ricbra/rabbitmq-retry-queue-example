<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('192.168.99.100', 5672, 'guest', 'guest');
$channel = $connection->channel();

$exchange           = 'task';
//$channel->queue_bind($retryQueue, $deadLetterExchange);

$data = implode(' ', array_slice($argv, 1));
if (! $data) {
    $data = 'H3ll0 W0rld';
}

$msg = new AMQPMessage(
    $data,
    [
        'delivery_mode' => 2,
    ]
);

$channel->basic_publish($msg, '', 'task');

echo " [x] Sent ", $data, "\n";

$channel->close();
$connection->close();
