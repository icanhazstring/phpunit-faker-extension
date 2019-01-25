<?php
declare(strict_types=1);

namespace PHPUnitFakerTest\Asset;

class TestProvider extends \Faker\Provider\Person
{
    protected static $titleMale = array('Bugs', 'Bunny');
}
