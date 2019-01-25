<?php
declare(strict_types=1);

namespace PHPUnitFaker;

use Faker\Generator;

trait FakerTrait
{
    // phpcs:disable
    /** @var Generator */
    private $__faker;
    /** @var int|null */
    private $__seed;
    // phpcs:enable

    /**
     * @param Generator $faker
     * @return void
     */
    public function injectFaker(Generator $faker): void
    {
        $this->__faker = $faker;
    }

    /**
     * @param int|null $seed
     * @return void
     */
    public function injectSeed(?int $seed): void
    {
        $this->__seed = $seed;
    }

    /**
     * @return Generator
     */
    public function fake(): Generator
    {
        if ($this->__faker === null) {
            throw FakerTestException::notInitialized();
        }

        // Always seed right before using faker
        $this->__faker->seed($this->__seed);

        return $this->__faker;
    }
}
