<?php

namespace src\Validators;

use src\Contracts\ValidatorContract;
use src\Document;

class ProhibitedWordsValidator implements ValidatorContract
{

    public function __construct(protected array $ruleProhibitedWords)
    {

    }

    /**
     * Validates that the document does not contain prohibited words.
     *
     * @param Document $document
     * @return array
     */
    public function validate(Document $document) : array
    {

        $isValid            = true;
        $errorMessages      = [];
        $prohibitedWords    = $this->ruleProhibitedWords ?? '';
        $content            = mb_strtolower($document->getContent() ?? '');

        if ($content === '' || $prohibitedWords === '') {
            return ['isValid' => true, 'errorMessages' => []];
        }

        // Get a words array from a document
        $docWords           = preg_split('/\s+/', $content);
        $prohibitedWords    = array_map('mb_strtolower', $this->ruleProhibitedWords);
        $foundWords         = array_intersect($prohibitedWords, $docWords);

        if (!empty($foundWords)) { // Prohibited words found
            // Populates the error messages array
            $errorMessages[] = sprintf(
                "Prohibited words found: %s",
                implode(', ', $foundWords)
            );

            $isValid = false;
        }

        return [
            'isValid' => $isValid,
            'errorMessages' => $errorMessages
        ];
    }
}