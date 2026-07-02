<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use src\Document;
use src\Factories\ValidationRuleFactory;
use src\Validator;

class ValidatorTest extends TestCase
{
    public function test_validate_returns_valid_result_when_all_rules_pass(): void
    {
        $document = new Document(
            id: 1,
            tenantId: 'tenant_a',
            content: 'Hello world',
            metadata: [
                'author' => 'John Doe',
                'created_at' => '2026-06-30',
            ]
        );

        $tenantRules = [
            'max_size' => 100,
            'prohibited_words' => ['test'],
            'required_metadata' => ['author'],
        ];

        $factory = new ValidationRuleFactory($tenantRules);
        $validator = new Validator($factory);

        $result = $validator->validate($document, $tenantRules);

        $this->assertTrue($result['isValid']);
        $this->assertEmpty($result['errorMessages']);
    }

    public function test_validate_returns_errors_when_validation_fails(): void
    {
        $document = new Document(
            id: 1,
            tenantId: 'tenant_a',
            content: 'Hello world',
            metadata: []
        );

        $tenantRules = [
            'max_size' => 5,
            'prohibited_words' => ['hello'],
            'required_metadata' => ['author'],
        ];

        $factory = new ValidationRuleFactory($tenantRules);
        $validator = new Validator($factory);

        $result = $validator->validate($document, $tenantRules);

        $this->assertFalse($result['isValid']);
        $this->assertCount(3, $result['errorMessages']);

        $this->assertContains(
            'Document size exceeds maximum allowed size of 5 characters',
            $result['errorMessages']
        );

        $this->assertContains('Prohibited words found: hello', $result['errorMessages']);

        $this->assertContains(
            "Required metadata field 'author' is missing",
            $result['errorMessages']
        );
    }
}