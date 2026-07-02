<?php

namespace src\Contracts;

use src\Document;

interface TenantRulesContract
{
    /**
     * Returns validation rules for given tenant
     *
     * @param string $tenantId
     * @return array
     */
    public function getTenantRules(string $tenantId) : array;
}