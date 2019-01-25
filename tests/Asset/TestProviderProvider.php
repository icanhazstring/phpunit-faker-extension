<?php
declare(strict_types=1);

namespace PHPUnitFakerTest\Asset;

class TestProviderProvider
{
    public function __invoke(): array
    {
        return [
            TestProvider::class
        ];
    }
}
