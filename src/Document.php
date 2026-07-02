<?php

namespace src;

use src\Contracts\DocumentContract;

class Document
{
    public function __construct(
        protected int $id,
        protected string $content,
        protected string $tenantId,
        protected array $metadata)
    {

    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }
}