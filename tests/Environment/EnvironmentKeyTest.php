<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Environment;

use Everfrost\Core\Environment\EnvironmentKey;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EnvironmentKeyTest extends TestCase
{
    #[DataProvider("validValues")]
    public function testItAcceptsValidValues(string $value): void
    {
        $key = new EnvironmentKey($value);
        $this->assertSame($value, $key->value());
    }

    public function testKeysWithTheSameValueAreEqual(): void
    {
        self::assertTrue(new EnvironmentKey("production")->equals(new EnvironmentKey("production")));
    }

    public function testKeysWithDifferentValuesAreNotEqual(): void
    {
        self::assertFalse(new EnvironmentKey("production")->equals(new EnvironmentKey("staging")));
    }

    #[DataProvider("invalidValues")]
    public function testItRejectsInvalidValues(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        new EnvironmentKey($value);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function validValues(): iterable
    {
        yield 'production' => ['production'];
        yield 'staging' => ['staging'];
        yield 'pre-production' => ['pre-production'];
        yield 'review environment' => ['review-42'];
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function invalidValues(): iterable
    {
        yield 'empty' => [''];
        yield 'uppercase' => ['Production'];
        yield 'starts with number' => ['42-review'];
        yield 'underscore' => ['pre_production'];
        yield 'space' => ['pre production'];
        yield 'starts with hyphen' => ['-production'];
        yield 'ends with hyphen' => ['production-'];
        yield 'double hyphen' => ['pre--production'];
    }
}
