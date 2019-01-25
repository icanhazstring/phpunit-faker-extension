<?php
declare(strict_types=1);

namespace PHPUnitFaker;

use RuntimeException;

class FakerTestException extends RuntimeException
{
    /**
     * @return FakerTestException
     */
    public static function notInitialized(): self
    {
        return new self('Faker not initialized. Did you implement PHPUnitFaker\FakerAwareTest?');
    }
}
