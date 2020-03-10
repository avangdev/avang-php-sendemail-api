<?php

require '../vendor/autoload.php';

use AvangPhpApi\Base;
use AvangPhpApi\ComposeRawMessage;

$host = 'https://example.com'; // example host address
$key = 'UoNHJGO0ADOaKSFNR3biSUasda';  // example key
$base = new Base($host, $key);
$composeMessage = new ComposeRawMessage($base);
$composeMessage->rcptTo('test@example.com');
$composeMessage->mailFrom('admin@example.com');
$composeMessage->data('This is a message to test the delivery of messages.');
$result = $composeMessage->send();
foreach ($result->recipients() as $email => $message) {
    echo 'email: '.$email.'<br/>';            // The e-mail address of the recipient
    echo 'id: '.$message->id().'<br/>';    // Returns the message ID
    echo 'token: '.$message->token().'<br/>'; // Returns the message's token
    echo '<hr>';
}
