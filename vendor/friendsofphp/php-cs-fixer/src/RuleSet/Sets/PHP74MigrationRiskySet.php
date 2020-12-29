<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace MolliePrefix\PhpCsFixer\RuleSet\Sets;

use MolliePrefix\PhpCsFixer\RuleSet\AbstractRuleSetDescription;
/**
 * @internal
 */
final class PHP74MigrationRiskySet extends \MolliePrefix\PhpCsFixer\RuleSet\AbstractRuleSetDescription
{
    public function getRules()
    {
        return ['@PHP71Migration:risky' => \true, 'implode_call' => \true, 'no_alias_functions' => \true, 'use_arrow_functions' => \true];
    }
    public function getDescription()
    {
        return 'Rules to improve code for PHP 7.1 compatibility.';
    }
}
