<?php

declare(strict_types=1);

use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;
use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/src/vendor',
        __DIR__ . '/src/data/cache',
        JsonThrowOnErrorRector::class,
        LongArrayToShortArrayRector::class, // As much as I'd like to use this, Rector will destroy the formatting of large, multi-line arrays when it applies this & PHP-CS-Fixer doesn't fix it.
        NullToStrictStringFuncCallArgRector::class,
    ]);


    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
    ]);

    $rectorConfig->cacheClass(FileCacheStorage::class);
    $rectorConfig->cacheDirectory('./cache/rector');
};
