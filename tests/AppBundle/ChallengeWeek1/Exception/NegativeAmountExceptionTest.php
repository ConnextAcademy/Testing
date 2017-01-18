<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception;

use \PHPUnit_Framework_TestCase;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\NegativeAmountException;

class NegativeAmountExceptionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException NegativeAmountException
     * @dataProvider paymentAmountProvider
     */
    public function testConstructorWithNegativeAmountThrowsException($input)
    {
        return new Payment($input);
    }

    public function paymentAmountProvider()
    {
        return [
            [-10, $this->expectException(NegativeAmountException::class)],
            ['-10', $this->expectException(NegativeAmountException::class)],
        ];
    }

}