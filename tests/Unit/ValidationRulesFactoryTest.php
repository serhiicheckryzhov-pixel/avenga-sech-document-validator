<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Factories\ValidationRuleFactory;
use src\Validators\MaxSizeValidator;

class ValidationRulesFactoryTest extends TestCase
{
    public function test_make_existing_rule_sucess()
    {
        $rulesFactory = new ValidationRuleFactory(['max_size' => 250]);
        $validator = $rulesFactory->make('max_size');

        $this->assertInstanceOf(
            MaxSizeValidator::class,
            $validator
        );
    }

    public function test_make_existing_rule_unsucess()
    {
        $this->expectException(\Exception::class);
        $rulesFactory = new ValidationRuleFactory(['unknown' => 250]);
        $rulesFactory->make('unknown');
    }
}