<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\NegativeAmountException;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use PHPUnit_Framework_TestCase;

class PaymentTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Payment constructor.
     *
     * @param float $amount
     * @param bool  $expectNegativeAmountException
     * @dataProvider providerTestConstructorThrowsNegativeAmountException
     */
    public function testConstructorThrowsNegativeAmountException($amount, $expectNegativeAmountException)
    {
        if ($expectNegativeAmountException) {
            $this->expectException(NegativeAmountException::class);
        }

        new Payment($amount);
    }

    /**
     * Data provider for testConstructorThrowsNegativeAmountException.
     *
     * @return array
     */
    public function providerTestConstructorThrowsNegativeAmountException()
    {
        return [
            [-10, true],
            [-10.00, true],
            [0, false],
            [0.00, false],
            [10, false],
            [10.00, false],
        ];
    }
}
