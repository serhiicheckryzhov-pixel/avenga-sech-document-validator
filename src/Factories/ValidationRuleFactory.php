<?php

namespace src\Factories;

use src\Contracts\ValidatorContract;
use src\Validators\MaxSizeValidator;
use src\Validators\MetadataValidator;
use src\Validators\ProhibitedWordsValidator;

class ValidationRuleFactory
{

    public function __construct(protected array $tenantRules) {}

    /**
     * Validation rules factory. Makes necessary instantces depending on validator's rule.
     *
     * @param string $rule
     * @return ValidatorContract
     */
    public function make(string $rule) : ValidatorContract
    {

        return match ($rule) {
            'max_size'              => new MaxSizeValidator($this->tenantRules['max_size'] ?? 0),
            'prohibited_words'      => new ProhibitedWordsValidator($this->tenantRules['prohibited_words'] ?? []),
            'required_metadata'     => new MetadataValidator($this->tenantRules['required_metadata'] ?? []),
            default => throw new \Exception(
                "Unknown validation rule: {$rule}"
            ),
        };
    }
}