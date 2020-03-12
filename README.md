# Avang REST client for Send Email

A simple Avang REST client library for PHP. This library allows you to quickly and easily use the Avang Web API via PHP for send Emails.
## Prerequisites

-   [An Avang SMTP account](https://avangemail.com/smtp)

## Installation

Make sure you have [composer](https://getcomposer.org) installed.

Require the package
```bash
composer require --prefer-dist avangdev/avang-php-sendemail-api dev-master
``` 

#### PHP Versions

Requires PHP >= 7.1

## Examples
**##### Send simple email** 

    require_once(__DIR__.'/../vendor/autoload.php');
    use AvangPhpApi\Base;
    use AvangPhpApi\ComposeMessage;
    
    $host = 'https://example.com'; //  host address
    $key = 'yourApiKey';  // example key
    $base = new Base($host, $key);
    $composeMessage = new ComposeMessage($base);
    $composeMessage->to('test@example.com');
    $composeMessage->from('John Doe<admin@example.com>');
    $composeMessage->sender('admin@example.com');
    $composeMessage->subject('Mail subjec');
    $composeMessage->replyTo('admin@example.com');
    $composeMessage->plainBody('Hello');
    $composeMessage->htmlBody('<h1>Hello</h1>');
    $composeMessage->attach('test.png', 'application/octet-stream', 'test');
    $result = $composeMessage->send();

[More Expample](https://github.com/avangdev/avang-php-sendemail-api/tree/master/examples)

