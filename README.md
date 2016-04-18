RabbitMQ retry queue
--------------------

This repository contains an example implementation of a retry queue with RabbitMQ. It is build using deadletter
exchange cycling. The idea is as following:

1. message gets published on task queue
2. consumer fails processing and nacks message
3. message is delivered to retry_task queue
4. as TTL passes, message is redeliverd to task queue and process starts all over

This can all be accomplished by just using RabbitMQ and one consumer. See the consumer.php for the relevant configuration.