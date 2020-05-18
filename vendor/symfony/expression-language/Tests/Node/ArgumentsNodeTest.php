<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5ea00cc67502b\Symfony\Component\ExpressionLanguage\Tests\Node;

use _PhpScoper5ea00cc67502b\Symfony\Component\ExpressionLanguage\Node\ArgumentsNode;
class ArgumentsNodeTest extends ArrayNodeTest
{
    public function getCompileData()
    {
        return [['"a", "b"', $this->getArrayNode()]];
    }
    public function getDumpData()
    {
        return [['"a", "b"', $this->getArrayNode()]];
    }
    protected function createArrayNode()
    {
        return new ArgumentsNode();
    }
}