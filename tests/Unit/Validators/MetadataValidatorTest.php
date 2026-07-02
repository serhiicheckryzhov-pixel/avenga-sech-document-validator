<?php

namespace Unit\Validators;

use PHPUnit\Framework\TestCase;
use src\Document;
use src\Validators\MetadataValidator;

class MetadataValidatorTest extends TestCase
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

    public function test_document_matadata_fields_required_is_valid(): void
    {
        $maxSizeValidator = new MetadataValidator(['author']);
        $result = $maxSizeValidator->validate($this->document);

        $this->assertTrue($result['isValid']);
        $this->assertEmpty($result['errorMessages']);
    }
}