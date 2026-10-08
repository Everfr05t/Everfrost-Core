<?php

declare(strict_types=1);

namespace Everfrost\Core\Tests\Capability;

use Everfrost\Core\Capability\Capability;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CapabilityTest extends TestCase
{
    public function testItStoresAValidCapability(): void
    {
        $capability = new Capability('deploy.files');
        self::assertSame('deploy.files', $capability->value());
    }

    public function testItAcceptsMoreThanTwoSegments(): void
    {
        $capability = new Capability('database.mysql.dump');
        self::assertSame('database.mysql.dump', $capability->value());
    }

    public function testCapabilitiesWithTheSameValueAreEquals(): void
    {
        $capability = new Capability('deploy.files');
        $other = new Capability('deploy.files');

        self::assertTrue($capability->equals($other));
    }

    public function testCapabilitiesWithDifferentValueAreNotEquals(): void
    {
        $capability = new Capability('deploy.files');
        $other = new Capability('deploy.docker');

        self::assertFalse($capability->equals($other));
    }

    #[DataProvider('invalidValues')]
    public function testItRejectsInvalidValues(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Capability($value);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function invalidValues(): iterable
    {
        yield 'empty' => [''];
        yield 'single segment' => ['deploy'];
        yield 'uppercase' => ['Deploy.files'];
        yield 'space' => ['deploy files'];
        yield 'double separator' => ['deploy..files'];
        yield 'starts with separator' => ['.deploy.files'];
        yield 'ends with separator' => ['deploy.files.'];
        yield 'segment starts with number' => ['deploy.2files'];
        yield 'first segment starts with number' => ['2deploy.files'];
        yield 'underscore' => ['deploy_files'];
        yield 'hyphen' => ['deploy.file-system'];
    }
}
