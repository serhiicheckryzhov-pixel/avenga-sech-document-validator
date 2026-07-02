<?php

namespace src\Validators;

use src\Contracts\ValidatorContract;
use src\Document;

class MaxSizeValidator implements ValidatorContract
{

    public function __construct(protected int $ruleMaxSize)
    {
    }

    /**
     * Validates that the document metadata includes required data.
     *
     * @param Document $document
     * @return array
     */
    public function validate(Document $document) : array
    {
        $content = $document->getContent() ?? '';

        if (mb_strlen($content) > $this->ruleMaxSize) {

            return [
                'isValid' => false,
                'errorMessages' => [
                    sprintf(
                        'Document size exceeds maximum allowed size of %d characters',
                        $this->ruleMaxSize
                    )
                ]
            ];
        }

        return [
            'isValid' => true,
            'errorMessages' => []
        ];
    }
}