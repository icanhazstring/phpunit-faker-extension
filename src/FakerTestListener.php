<?php
declare(strict_types=1);

namespace PHPUnitFaker;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class FakerTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    private $suites = 0;
    private $faker;
    private $seed;

    public function __construct(array $options = [])
    {
        $this->faker = Factory::create($options['locale'] ?? Factory::DEFAULT_LOCALE);

        $this->seed = $this->fetchSeed();
        $providerProvider = $this->prepareProvider($options['fakerProviderProvider'] ?? null);

        $this->attachProvider($this->faker, $providerProvider);
    }

    /**
     * Start testsuite inject faker into every test
     *
     * @param TestSuite $suite
     * @return void
     * @throws \Exception
     */
    public function startTestSuite(TestSuite $suite): void
    {
        $this->suites++;

        foreach ($suite->tests() as $test) {
            if ($test instanceof FakerAwareTest) {
                $test->injectFaker($this->faker);
                $test->injectSeed($this->seed);
            }
        }
    }

    public function endTestSuite(TestSuite $suite): void
    {
        $this->suites--;

        if ($this->suites > 0) {
            return;
        }

        echo \sprintf("\n\nTests done with seed: %u", $this->seed);
    }

    /**
     * Fetch seed from environment or random int if none.
     * @return int
     */
    private function fetchSeed(): int
    {
        $seed = \getenv('PHPUNIT_SEED');

        if (!$seed) {
            try {
                $seed = \random_int(1, 9999);
            } catch (\Exception $e) {
                $seed = 1;
            }
        }

        return (int)$seed;
    }

    private function prepareProvider(?string $providerClass): callable
    {
        if ($providerClass === null) {
            return static function () {
                return [];
            };
        }

        return new $providerClass();
    }

    private function attachProvider(Generator $faker, callable $providerProvider): void
    {
        foreach ($providerProvider() as $provider) {
            if (\is_string($provider)) {
                $provider = new $provider($faker);
            }

            $faker->addProvider($provider);
        }
    }
}
