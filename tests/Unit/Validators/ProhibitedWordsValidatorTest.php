<?php

namespace Tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use src\Document;
use src\Validators\ProhibitedWordsValidator;

class ProhibitedWordsValidatorTest extends TestCase
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

    /**
     * Case if document does not include prohibited words.
    */
    public function test_prohibited_words_not_include(): void
    {

        $prohibitedWordsValidator = new ProhibitedWordsValidator(['test', 'something', 'valid']);
        $result = $prohibitedWordsValidator->validate($this->document);

        $this->assertTrue($result['isValid']);
        $this->assertEmpty($result['errorMessages']);
    }

    /**
     * Case if document includes prohibited words and error messages.
     */
    public function test_prohibited_words_include(): void
    {
        $prohibitedWordsValidator = new ProhibitedWordsValidator(['hello']);
        $result = $prohibitedWordsValidator->validate($this->document);

        $this->assertFalse($result['isValid']);
        $this->assertNotEmpty($result['errorMessages']);
        $this->assertContains('Prohibited words found: hello', $result['errorMessages']);
    }

    /**
     * Case of empty prohibited words config
     */
    public function test_case_empty_prohibited_words(): void
    {
        $prohibitedWordsValidator = new ProhibitedWordsValidator([]);
        $result = $prohibitedWordsValidator->validate($this->document);

        $this->assertTrue($result['isValid']);
        $this->assertEmpty($result['errorMessages']);

    }

}