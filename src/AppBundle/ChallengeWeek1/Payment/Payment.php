<?php

namespace ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Payment;

use ConnectHolland\UnitTestTutorial\AppBundle\ChallengeWeek1\Exception\NegativeAmountException;

class Payment
{

    private $amount;

    public function __construct($amount)
    {
        if ($amount < 0) {
            throw new NegativeAmountException(sprintf('The given amount "%f" is negative, this is not allowed', $amount));
        }
        else if (!is_numeric($amount)) {
            throw new AmountNotANumberException(sprintf('The given amount "%f" is not a number, this is not allowed', $amount));
        }
        $this->amount = $amount;
    }

}