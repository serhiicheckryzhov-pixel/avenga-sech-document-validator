<?php

namespace src;

class TenantRules
{
    protected array $tenantRulesConfig;

    public function __construct()
    {
        $this->tenantRulesConfig = require __DIR__ . '/../config/tenant.rules.config.php';
    }

    /**
     * Returns the validation rules for the specified tenant.
     *
     * @param string $tenantId
     * @return array
     */
    public function getTenantRules(string $tenantId) : array
    {
        return $this->tenantRulesConfig[$tenantId] ?? [];
    }
}