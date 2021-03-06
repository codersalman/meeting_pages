<?php

declare(strict_types=1);

namespace Kreait\Firebase\JWT;

/**
 * @internal
 */
final class Util
{
    public static function authEmulatorHost(): string
    {
        $emulatorHost = self::getenv('FIREBASE_AUTH_EMULATOR_HOST');

        if (!\in_array($emulatorHost, [null, ''], true)) {
            return $emulatorHost;
        }

        return '';
    }

    public static function getenv(string $name): ?string
    {
        $value = $_SERVER[$name] ?? $_ENV[$name] ?? \getenv($name);

        if ($value !== false && $value !== null) {
            return (string)$value;
        }

        return null;
    }
}
