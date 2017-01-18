<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception;

use \PHPUnit_Framework_TestCase;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Result;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\ProcessorPassException;

class ProcessorPassExceptionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException ProcessorPassException
     */
    public function testIsSuccessThrowsException()
    {
        $payment = new Payment(10);

        $result = new Result();
        $result->setProcessorPassed(false);

        $paypal = $this->getMockBuilder(PayPalProvider::class)
                       ->getMock();

        $paypal->expects($this->once())
               ->method('processPayment')
               ->will($this->returnValue($result));

        $result->isSuccess();
    }

    /**
     * @expectedException ProcessorPassException
     */
    public function testGetTransactionIdThrowsException()
    {
        $result = new Result();
        $result->setTransactionId(null);
        $result->getTransactionId();
    }

    /**
     * @expectedException ProcessorPassException
     */
    public function testSetProcessorPassedThrowsException()
    {
        $result = new Result();
        $result->setProcessorPassed(1);
    }

}
