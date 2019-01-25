<?php
declare(strict_types=1);

namespace PHPUnitFaker;

use RuntimeException;

class ProviderException extends RuntimeException
{
    public static function notInvokable(string $class): self
    {
        return new self(\sprintf('Provider %s is not invokable', $class));
    }
}
