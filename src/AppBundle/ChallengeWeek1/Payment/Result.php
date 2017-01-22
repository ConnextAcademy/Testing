<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\ProcessorPassException;

class Result
{

    private $success;
    private $transactionId;
    private $processorPassed;

    public function __construct()
    {
        $this->success = false;
        $this->processorPassed = false;
    }

    public function isSuccess()
    {
        if (!$this->processorPassed) {
            throw new ProcessorPassException('The transaction has not passed yet, result not available');
        }
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getTransactionId()
    {
        if (!$this->processorPassed) {
            throw new ProcessorPassException('The transaction has not passed yet, id not available');
        }
        return $this->transactionId;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function isProcessorPassed()
    {
        return $this->processorPassed;
    }

    public function setProcessorPassed($processorPassed)
    {
        if ($this->processorPassed) {
            throw new ProcessorPassException('The transaction has already passed');
        }
        $this->processorPassed = $processorPassed;
    }

}
