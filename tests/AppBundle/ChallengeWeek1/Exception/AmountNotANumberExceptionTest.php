<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception;

use \PHPUnit_Framework_TestCase;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\AmountNotANumberException;

class AmountNotANumberExceptionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException AmountNotANumberException
     * @dataProvider paymentAmountProvider
     */
    public function testConstructorWithNonNumberAmountThrowsException($input)
    {
        return new Payment($input);
    }

    public function paymentAmountProvider()
    {
        return [
            ['abc', $this->expectException(AmountNotANumberException::class)],
            ['!@#$%^&*()',  $this->expectException(AmountNotANumberException::class)],
        ];
    }
}
