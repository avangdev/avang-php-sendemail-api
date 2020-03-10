<?php

require '../vendor/autoload.php';

use AvangPhpApi\Base;
use AvangPhpApi\ComposeMessage;

$host = 'https://example.com'; // example host address
$key = 'UoNHJGO0ADOaKSFNR3biSUasda';  // example key
$base = new Base($host, $key);
$composeMessage = new ComposeMessage($base);
$composeMessage->to('test@example.com');
$composeMessage->from('admin@example.com');
$composeMessage->sender('admin@example.com');
$composeMessage->subject('Test Message at ' . date("F j, Y, g:i a"));
$composeMessage->tag('test email');
$composeMessage->replyTo('admin@example.com');
$composeMessage->plainBody('This is a message to test the delivery of messages.');
$composeMessage->htmlBody('<doctype><html>this is is a message to test the delivery of messages.</html>');
$composeMessage->header('X-HEADER', 'test');
$composeMessage->attach('test.png', 'application/octet-stream', 'test');
$result = $composeMessage->send();
foreach ($result->recipients() as $email => $message) {
    echo 'email: '.$email.'<br/>';            // The e-mail address of the recipient
    echo 'id: '.$message->id().'<br/>';    // Returns the message ID
    echo 'token: '.$message->token().'<br/>'; // Returns the message's token
    echo '<hr>';
}
