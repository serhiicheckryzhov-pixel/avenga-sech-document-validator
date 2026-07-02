<?php

namespace src;

use src\Factories\ValidationRuleFactory;

class Validator
{

    public function __construct(protected ValidationRuleFactory $factory)
    {

    }

    /**
     * Returns validation result for the Document depending on tenant's rules.
     *
     * @param Document $document
     * @param array $tenantRules
     * @return array
     */
    public function validate(Document $document, array $tenantRules): array
    {
        $result = [
            'isValid' => true,
            'errorMessages' => []
        ];

        foreach ($tenantRules as $ruleKey => $ruleConfig) {

            $validationRule = $this->factory->make($ruleKey);

            $validationResult = $validationRule->validate($document);

            if (!$validationResult['isValid']) {
                $result['isValid'] = false;

                $result['errorMessages'] = array_merge(
                    $result['errorMessages'],
                    $validationResult['errorMessages']
                );
            }
        }

        return $result;
    }
}