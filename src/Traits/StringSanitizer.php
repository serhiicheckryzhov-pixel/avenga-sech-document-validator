<?php
namespace src\Traits;

Trait StringSanitizer {
    protected function sanitize(string $content) : string {
        return strtolower(trim(strip_tags($content)));
    }
}
