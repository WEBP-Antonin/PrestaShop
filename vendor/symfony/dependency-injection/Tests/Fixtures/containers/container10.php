<?php

namespace _PhpScoper5ea00cc67502b;

require_once __DIR__ . '/../includes/classes.php';
use _PhpScoper5ea00cc67502b\Symfony\Component\DependencyInjection\ContainerBuilder;
use _PhpScoper5ea00cc67502b\Symfony\Component\DependencyInjection\Reference;
$container = new ContainerBuilder();
$container->register('foo', 'FooClass')->addArgument(new Reference('bar'))->setPublic(true);
return $container;