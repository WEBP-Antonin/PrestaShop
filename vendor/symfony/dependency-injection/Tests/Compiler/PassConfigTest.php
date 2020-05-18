<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5ea00cc67502b\Symfony\Component\DependencyInjection\Tests\Compiler;

use _PhpScoper5ea00cc67502b\PHPUnit\Framework\TestCase;
use _PhpScoper5ea00cc67502b\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use _PhpScoper5ea00cc67502b\Symfony\Component\DependencyInjection\Compiler\PassConfig;
/**
 * @author Guilhem N <egetick@gmail.com>
 */
class PassConfigTest extends TestCase
{
    public function testPassOrdering()
    {
        $config = new PassConfig();
        $config->setBeforeOptimizationPasses([]);
        $pass1 = $this->getMockBuilder(CompilerPassInterface::class)->getMock();
        $config->addPass($pass1, PassConfig::TYPE_BEFORE_OPTIMIZATION, 10);
        $pass2 = $this->getMockBuilder(CompilerPassInterface::class)->getMock();
        $config->addPass($pass2, PassConfig::TYPE_BEFORE_OPTIMIZATION, 30);
        $passes = $config->getBeforeOptimizationPasses();
        $this->assertSame($pass2, $passes[0]);
        $this->assertSame($pass1, $passes[1]);
    }
}