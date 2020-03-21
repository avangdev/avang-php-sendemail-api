<?php

declare(strict_types=1);

namespace AvangPhpApi\Test;

use AvangPhpApi\Test\Base;
use AvangPhpApi\ComposeMessage;

class ComposeMessageTest extends Base {

    /**
     *
     * @var ComposeMessage 
     */
    private $_composeMessage;

    public function __construct() {
        parent::__construct();
        $client = parent::getApi();
        $this->_composeMessage = new ComposeMessage($client);
    }

    /**
     * test to function
     * @return void
     */
    final public function testTo(): void {
        $this->_composeMessage->to('masihfathi@gmail.com');
        $to = $this->_composeMessage->attributes['to'][0];
        $this->assertEquals('masihfathi@gmail.com', $to);
    }

    /**
     * test cc function
     * @return void
     */
    final public function testCc(): void {
        $this->_composeMessage->cc('webus.us@gmail.com');
        $cc = $this->_composeMessage->attributes['cc'][0];
        $this->assertEquals('webus.us@gmail.com', $cc);
    }

    /**
     * test bcc function
     * @return void
     */
    final public function testBcc(): void {
        $this->_composeMessage->bcc('webus.us@gmail.com');
        $bcc = $this->_composeMessage->attributes['bcc'][0];
        $this->assertEquals('webus.us@gmail.com', $bcc);
    }

    /**
     * test from function
     * @return void
     */
    final public function testFrom(): void {
        $this->_composeMessage->from('webus.us@gmail.com');
        $from = $this->_composeMessage->attributes['from'];
        $this->assertEquals('webus.us@gmail.com', $from);
    }

    /**
     * test sender function
     * @return void
     */
    final public function testSender(): void {
        $this->_composeMessage->sender('webus.us@gmail.com');
        $sender = $this->_composeMessage->attributes['sender'];
        $this->assertEquals('webus.us@gmail.com', $sender);
    }

    /**
     * test subject function
     * @return void
     */
    final public function testSubject(): void {
        $this->_composeMessage->subject('test email');
        $subject = $this->_composeMessage->attributes['subject'];
        $this->assertEquals('test email', $subject);
    }

    /**
     * test tag function
     * @return void
     */
    final public function testTag(): void {
        $this->_composeMessage->tag('register emails');
        $tag = $this->_composeMessage->attributes['tag'];
        $this->assertEquals('register emails', $tag);
    }

    /**
     * test replyTo function
     * @return void
     */
    final public function testReplyTo(): void {
        $this->_composeMessage->replyTo('webus.us@gmail.com');
        $reply_to = $this->_composeMessage->attributes['reply_to'];
        $this->assertEquals('webus.us@gmail.com', $reply_to);
    }

    /**
     * test plainBody function
     * @return void
     */
    final public function testPlainBody(): void {
        $this->_composeMessage->plainBody('hi test email');
        $plain_body = $this->_composeMessage->attributes['plain_body'];
        $this->assertEquals('hi test email', $plain_body);
    }

    /**
     * test htmlBody function
     * @return void
     */
    final public function testHtmlBody(): void {
        $this->_composeMessage->htmlBody('<doctype> <html>hi test email</html>');
        $html_body = $this->_composeMessage->attributes['html_body'];
        $this->assertEquals('<doctype> <html>hi test email</html>', $html_body);
    }

    /**
     * test Header function
     * @return void
     */
    final public function testHeaderSet(): void {
        $this->_composeMessage->header('X-HEADER', 'test');
        $header = $this->_composeMessage->attributes['headers']['X-HEADER'];
        $this->assertEquals('test', $header);
    }

    /**
     * test attachment function
     * @return void
     */
    final public function testAttachment(): void {
        $this->_composeMessage->attach('test.png', 'application/octet-stream', 'test');
        $name = $this->_composeMessage->attributes['attachments'][0]['name'];
        $content_type = $this->_composeMessage->attributes['attachments'][0]['content_type'];
        $data = $this->_composeMessage->attributes['attachments'][0]['data'];
        $this->assertEquals('test.png', $name);
        $this->assertEquals('application/octet-stream', $content_type);
        $this->assertEquals('dGVzdA==', $data);
    }

    /**
     * test sending message
     */
    final public function testSendMessage(): void {
        $this->_composeMessage->to('webus.us@gmail.com');
        $this->_composeMessage->from('admin@webus.us');
        $this->_composeMessage->sender('admin@webus.us');
        $this->_composeMessage->subject('Test Message at ' . date("F j, Y, g:i a"));
        $this->_composeMessage->tag('test email');
        $this->_composeMessage->replyTo('admin@webus.us');
        $this->_composeMessage->plainBody('This is a message to test the delivery of messages.');
        $this->_composeMessage->header('X-HEADER', 'test');
        $this->_composeMessage->attach('test.png', 'application/octet-stream', 'test');
        $result = $this->_composeMessage->send();
        foreach ($result->recipients() as $email => $message) {
            $this->assertEquals('webus.us@gmail.com', $email);
        }
    }

}
