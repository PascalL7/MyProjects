<?php

use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\TestListener;

class MyTestListener implements TestListener
{
    public function addError(Test $test, Throwable $e, float $time): void
    {
        printf("Error while running test '%s'.\n", $test->getName());
    }

    public function addWarning(Test $test, Warning $e, float $time): void
    {
        printf("Warning while running test '%s'.\n", $test->getName());
    }

    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        printf("Test '%s' %s\n", $test->getName(), "\033[31mFAILED !");
    }

    public function addIncompleteTest(Test $test, Throwable $e, float $time): void
    {
        printf("Test \e[43m'%s' is incomplete.\n", $test->getName());
    }

    public function addRiskyTest(Test $test, Throwable $e, float $time): void
    {
        printf("Test \e[43m'%s' is deemed risky.\n", $test->getName());
    }

    public function addSkippedTest(Test $test, Throwable $e, float $time): void
    {
        printf("Test \e[46m'%s' has been skipped.\n", $test->getName());
    }

    public function startTest(Test $test): void
    {
        // TODO: Implement startTest() method.
    }

    public function endTest(Test $test, float $time): void
    {
        // TODO: Implement endTest() method.
    }

    public function startTestSuite(TestSuite $suite): void
    {
        printf("TestSuite '%s' started.\n", $suite->getName());
    }

    public function endTestSuite(TestSuite $suite): void
    {
        printf("TestSuite '%s' ended.\n", $suite->getName());
    }
}
