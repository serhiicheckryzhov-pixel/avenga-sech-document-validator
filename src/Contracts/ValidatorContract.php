<?php

namespace src\Contracts;

use src\Document;
use src\TenantRules;

interface ValidatorContract
{
    /**
     * Validates the given document.
     *
     * @param Document $document
     * @return array{
     *     isValid: bool,
     *     errorMessages: string[]
     * }
     */
    public function validate(Document $document) : array;
}