<?php
declare(strict_types=1);

namespace PHPUnitFakerTest;

use PHPUnit\Framework\TestCase;
use PHPUnitFaker\FakerAwareTest;
use PHPUnitFaker\FakerTrait;

class FakerTest extends TestCase implements FakerAwareTest
{
    use FakerTrait;

    /**
     * @test
     * @return void
     */
    public function itShouldGenerateSameFakerValue(): void
    {
        $name1 = $this->fake()->name();
        $name2 = $this->fake()->name();

        $this->assertEquals($name1, $name2);
    }

    /**
     * @test
     * @return void
     */
    public function itShouldContainCustomTitle(): void
    {
        $this->assertContains($this->fake()->titleMale, ['Bugs', 'Bunny']);
    }
}
