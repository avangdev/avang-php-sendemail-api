<?php

declare(strict_types=1);

namespace AvangPhpApi\Test;

use PHPUnit\Framework\TestCase;
use AvangPhpApi\Base as AvangPhpApiBase;

/**
 * Class Base
 * @package LeaderSend\Test
 */
class Base extends TestCase {

    /**
     * @return AvangPhpApiBase
     * @throws \Exception
     */
    public function getApi(): AvangPhpApiBase {
        $host = getenv('HOST');
        $key = getenv('KEY');
        if (empty($host)) {
            throw new \Exception('Please provide host by setting you HOST environment variable!!');
        }
        if (empty($key)) {
            throw new \Exception('Please provide the right api key by setting you KEY environment variable!');
        }
        return new AvangPhpApiBase($host, $key);
    }

}
