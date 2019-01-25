<?php
declare(strict_types=1);

namespace PHPUnitFaker;

use Faker\Generator;

interface FakerAwareTest
{
    /**
     * @param Generator $faker
     * @return void
     */
    public function injectFaker(Generator $faker): void;

    /**
     * Inject the seed to tests.
     *
     * Each time we call fake() the seed needs to be applied.
     * If there is not seed, random data will occur
     *
     * @param int|null $seed
     * @return void
     */
    public function injectSeed(?int $seed): void;

    /**
     * @return Generator
     */
    public function fake(): Generator;
}
