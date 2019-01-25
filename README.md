# phpunit-faker-extension

![Build](https://img.shields.io/travis/com/icanhazstring/phpunit-faker-extension/master.svg)
![Min php version](https://img.shields.io/badge/php-%5E7.1-lightgrey.svg)
![Min phpunit version](https://img.shields.io/badge/phpunit%2Fphpunit-%5E7.5-lightgrey.svg)

Using this extension you can use [fzaninotto/faker](https://github.com/fzaninotto/faker) with your phpunit tests. 
Every test will be seeded so you will be able run the same test again if an error occurs.

![phpunit-faker-extension-screenshot](https://i.imgur.com/5aYU9hJ.png)

## Installation

You can install this extension by using [Composer](http://getcomposer.org). This package should be added as a `require-dev` dependency:

    composer require --dev icanhazstring/phpunit-faker-extension


## Usage

Enable with all defaults by adding the following code to your project's `phpunit.xml` file:

```xml
<phpunit bootstrap="vendor/autoload.php">
...
    <listeners>
        <listener class="PHPUnitFaker\FakerTestListener" />
    </listeners>
</phpunit>
```

Now run the test suite as normal. As soon as all tests are completed, 
you will see a seed that was used to generate the faker data:

`Tests done with seed: XXX`

### Using Fake inside a test

To use faker inside your tests, you will need to implement the `FakerAwareTest` interface and the `FakerTrait`.
Since not all tests will need faker, the interface makes sure only tests using faker, will get the needed data.

To actually invoke you only need to do the following:

```php
class AwesomeTest extends TestCase implements FakerAwareTest
{
    use FakerTrait;
    
    public function testAwesomeStuff(): void
    {
        $this->assertSame($this->fake()->name, $this->fake()->name);
    }
}
```
> See faker documentation for more information about formatters: https://github.com/fzaninotto/faker#formatters

### Running tests with a given seed

To run tests with a given seed, simple set the `PHPUNIT_SEED` environment variable before running phpunit:

```bash
$ PHPUNIT_SEED=XXX vendor/bin/phpunit
```

## Configuration

This extension has three configurable parameters:
- **locale** - The locale that faker should use (Default: `en_GB`)
- **fakerProviderProvider** - (Silly name I know) A single invokable class returning a list of providers (string or instance)

These configuration parameters are set in `phpunit.xml` when adding the listener:

```xml
<phpunit bootstrap="vendor/autoload.php">
    <!-- ... other suite configuration here ... -->

    <listeners>
        <listener class="PHPUnitFaker\FakerTestListener">
            <arguments>
                <array>
                    <element key="locale">
                        <string>de_DE</string>
                    </element>
                    <element key="fakerProviderProvider">
                        <string>Your\FakerProviderProvider</string>
                    </element>
                </array>
            </arguments>
        </listener>
    </listeners>
</phpunit>
```

## License

phpunit-faker-extension is available under the MIT License.
