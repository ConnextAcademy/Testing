<?php

namespace Tests\ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\ProcessorPassException;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Payment;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Processor;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Providers\PayPalProvider;
use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment\Result;
use PHPUnit_Framework_TestCase;

class ResultTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up.
     */
    protected function setUp()
    {
    }

    /**
     * Tear down.
     */
    protected function tearDown()
    {
    }

    /**
     * Test is success function throws ProcesserPassException before transaction.
     */
    public function testIsSuccessThrowsExceptionBeforeTransaction()
    {
        $this->expectException(ProcessorPassException::class);
        $this->expectExceptionMessage('The transaction has not passed yet, result not available');

        $result = new Result();
        $result->setSuccess(true);

        echo $result->isSuccess();
    }

    /**
     * Test is success function returns true after transaction.
     */
    public function testIsSuccessReturnsTrueAfterTransaction()
    {
        $result = $this->doTransaction();

        $this->assertEquals(true, $result->isSuccess());
    }

    /**
     * Test get transaction id function throws ProcesserPassException before transaction.
     */
    public function testGetTransactionIdThrowsExceptionBeforeTransaction()
    {
        $this->expectException(ProcessorPassException::class);
        $this->expectExceptionMessage('The transaction has not passed yet, id not available');

        $result = new Result();

        echo $result->getTransactionId();
    }

    /**
     * Test get transaction id returns ID after transaction.
     */
    public function testGetTransactionIdReturnsIdAfterTransaction()
    {
        $result = $this->doTransaction();

        $this->assertEquals(7, $result->getTransactionId());
    }

    /**
     * Test set processer passed function throws ProcesserPassException after transaction.
     */
    public function testSetProcessorPassedThrowsExceptionAfterTransaction()
    {
        $this->expectException(ProcessorPassException::class);
        $this->expectExceptionMessage('The transaction has already passed');

        $payment = new Payment(12.75);
        $result = new Result();

        $paypal = $this->getMockBuilder(PayPalProvider::class)
            ->getMock();

        $paypal->expects($this->once())
            ->method('processPayment')
            ->will($this->returnValue($result));

        $processor = new Processor($paypal);
        $result = $processor->doPayment($payment);

        $result->setProcessorPassed(false);
    }

    /**
     * Do transaction.
     *
     * @return Result
     */
    protected function doTransaction()
    {
        $payment = new Payment(12.75);
        $result = new Result();
        $result->setSuccess(true);
        $result->setTransactionId(7);

        $paypal = $this->getMockBuilder(PayPalProvider::class)
            ->getMock();

        $paypal->expects($this->once())
            ->method('processPayment')
            ->will($this->returnValue($result));

        $processor = new Processor($paypal);
        $result = $processor->doPayment($payment);

        return $result;
    }
}
