<?php

namespace FocusCMS\ComposerThemeInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    /**
     * Telepítési útvonal
     */
    public function getInstallPath(PackageInterface $package): string
    {
        $themeName = self::getThemeNameForPackage($package);

        return "Themes/{$themeName}";
    }

    /**
     * Csak focus-theme csomagokat kezeli
     */
    public function supports($packageType): bool
    {
        return $packageType === 'focus-theme';
    }

    /**
     * Theme név meghatározása
     *
     * vendor/package-name → PackageName
     */
    public static function getThemeNameForPackage(
        PackageInterface $package
    ): string {

        $packageName = $package->getPrettyName();

        if (str_contains($packageName, '/')) {
            $packageName = explode('/', $packageName)[1];
        }

        $themeName = str_replace('-', ' ', $packageName);
        $themeName = ucwords($themeName);

        return str_replace(' ', '', $themeName);
    }
}