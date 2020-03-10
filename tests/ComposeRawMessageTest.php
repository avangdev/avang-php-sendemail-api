<?php

declare(strict_types=1);

namespace AvangPhpApi\Test;

use AvangPhpApi\Test\Base;
use AvangPhpApi\ComposeRawMessage;

class ComposeRawMessageTest extends Base {

    /**
     *
     * @var ComposeRawMessage 
     */
    private $_composeMessage;

    public function __construct() {
        parent::__construct();
        $client = parent::getApi();
        $this->_composeMessage  = new ComposeRawMessage($client);
    }

    /**
     * test mailFrom function
     * @return void
     */
    final public function testMailFrom(): void {
        $this->_composeMessage->mailFrom('masihfathi@gmail.com');
        $mailFrom = $this->_composeMessage->attributes['mail_from'];
        $this->assertEquals('masihfathi@gmail.com', $mailFrom);
    }

    /**
     * test rcptTo function
     * @return void
     */
    final public function testRcptTo(): void {
        $this->_composeMessage->rcptTo('webus.us@gmail.com');
        $rcpt_to = $this->_composeMessage->attributes['rcpt_to'][0];
        $this->assertEquals('webus.us@gmail.com', $rcpt_to);
    }

    /**
     * test data function
     * @return void
     */
    final public function testData(): void {
        $this->_composeMessage->data('test');
        $data = $this->_composeMessage->attributes['data'];
        $this->assertEquals('dGVzdA==', $data);
    }
    /**
     * test sending raw message
     */
    final public function testSendMessage(): void {
        $this->_composeMessage->rcptTo('webus.us@gmail.com');
        $this->_composeMessage->mailFrom('admin@webus.us');
        $this->_composeMessage->data('This is a message to test the delivery of messages.');
        $result = $this->_composeMessage->send();
        foreach ($result->recipients() as $email => $message) {
            $this->assertEquals('webus.us@gmail.com', $email);
        }
    }

}
