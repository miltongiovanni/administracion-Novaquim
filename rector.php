<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonySetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/config',
    ])
    // 1. Definimos el nivel de PHP 8.2 (esto ya incluye la conversión a atributos)
    ->withPhpSets(php82: true)

    // 2. Activamos las reglas de Symfony (sustituye a los antiguos LevelSets)
    ->withSymfonyContainerXml(__DIR__ . '/var/cache/dev/App_KernelDevDebugContainer.xml')
    ->withAttributesSets(symfony: true)

    // 3. Cargamos los sets de reglas disponibles en tu versión
    ->withSets([
        SymfonySetList::SYMFONY_64,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
    ])

    // 4. Importación automática de clases (para que #[Route] no use el FQN largo)
    ->withImportNames();