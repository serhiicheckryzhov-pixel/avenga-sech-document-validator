<?php

namespace Unit\Validators;

use PHPUnit\Framework\TestCase;
use src\Document;
use src\Validators\MaxSizeValidator;

class MaxSizeValidatorTest extends TestCase
{
    private Document $document;
    protected function setUp(): void
    {
        parent::setUp();

        $this->document = new Document(
            id: 1,
            tenantId: 'tenant_a',
            content: 'Hello world! Content for validation',
            metadata: [
                'author' => 'John Doe',
                'created_at' => '2026-06-30',
            ]
        );
    }


    public function test_document_within_max_size_is_valid(): void
    {
        $maxSizeValidator = new MaxSizeValidator(250);
        $result = $maxSizeValidator->validate($this->document);

        $this->assertTrue($result['isValid']);
        $this->assertEmpty($result['errorMessages']);
    }

    public function test_document_exceeding_max_size_is_invalid(): void
    {
        $maxSizeValidator = new MaxSizeValidator(1);
        $result = $maxSizeValidator->validate($this->document);

        $this->assertFalse($result['isValid']);
        $this->assertNotEmpty($result['errorMessages']);
        $this->assertContains('Document size exceeds maximum allowed size of 1 characters', $result['errorMessages']);
    }
}