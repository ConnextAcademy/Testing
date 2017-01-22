<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Controller;

use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * Test exception action.
     *
     * @param string $url
     * @param bool   $expectedHasRuntimeException
     * @dataProvider providerTestExceptionRouteThrowsRuntimeException
     */
    public function testExceptionRouteThrowsRuntimeException($url, $expectRuntimeException)
    {
        $client = static::createClient();
        $client->enableProfiler();
        $client->request('GET', $url);

        $profile = $client->getProfile();
        $hasRuntimeException = $profile->getCollector('exception')->hasException(RuntimeException::class);

        $this->assertEquals($expectRuntimeException, $hasRuntimeException);
    }

    /**
     * Data provider for testExceptionRouteThrowsRuntimeException.
     *
     * @return array
     */
    public function providerTestExceptionRouteThrowsRuntimeException()
    {
        return [
            ['/', false],
            ['/exception', true],
        ];
    }
}
