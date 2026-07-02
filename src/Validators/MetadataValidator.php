<?php

namespace src\Validators;

use src\Contracts\ValidatorContract;
use src\Document;

class MetadataValidator implements ValidatorContract
{

    public function __construct(protected array $requiredMetadataFields)
    {

    }

    /**
     * Check is required metada fields exists and not empty
     *
     * @param Document $document
     * @return array
     */
    public function validate(Document $document) : array
    {
        $isValid            = true;
        $errorMessages      = [];

        $metadata = $document->getMetadata();

        foreach ($this->requiredMetadataFields as $field) {
            if (
                !array_key_exists($field, $metadata)
                || empty($metadata[$field])
            ) {
                $errorMessages[] = sprintf(
                    "Required metadata field '%s' is missing",
                    $field
                );

                $isValid = false;
            }
        }

        return [
            'isValid'       => $isValid,
            'errorMessages' => $errorMessages,
        ];
    }
}