<?php

require_once 'bootstrap/boot.php';

$node = new Node();
$node->npm('opts', 'coffeekup', 'express', 'socket.io');
$node->set_port(6015);
$node->set_request_type('cli');

exit($node->request());