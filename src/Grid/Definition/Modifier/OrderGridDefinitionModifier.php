<?php
/**
 * Copyright (c) 2012-2020, Mollie B.V.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 *
 * @author     Mollie B.V. <info@mollie.nl>
 * @copyright  Mollie B.V.
 * @license    Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Mollie
 *
 * @see       https://www.mollie.nl
 * @codingStandardsIgnoreStart
 */

namespace Mollie\Grid\Definition\Modifier;

use Mollie;
use Mollie\Grid\Action\Type\SecondChanceRowAction;
use Mollie\Grid\Row\AccessibilityChecker\SecondChanceAccessibilityChecker;
use PrestaShop\PrestaShop\Core\Grid\Action\Row\RowActionCollection;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\Common\ActionColumn;
use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinitionInterface;

class OrderGridDefinitionModifier implements GridDefinitionModifierInterface
{
    private $module;

    public function __construct(Mollie $module)
    {
        $this->module = $module;
    }

    /**
     * @inheritDoc
     */
    public function modify(GridDefinitionInterface $gridDefinition)
    {
        $translator = $this->module->getTranslator();

        $gridDefinition->getColumns()
            ->addBefore('date_add', (new ActionColumn('second_chance'))
                ->setName($translator->trans('Resend payment link', [], 'Modules.mollie'))
                ->setOptions([
                    'actions' => (new RowActionCollection())
                        ->add((new SecondChanceRowAction('transaction_id'))
                            ->setName($translator->trans('You will resend email with payment link to the customer', [], 'Modules.mollie'))
                            ->setOptions([
                                'route' => Mollie\Config\Config::ROUTE_RESEND_SECOND_CHANCE_PAYMENT_MESSAGE,
                                'route_param_field' => 'id_order',
                                'route_param_name' => 'orderId',
                                'use_inline_display' => true,
                                'accessibility_checker' => $this->module->getMollieContainer(
                                    SecondChanceAccessibilityChecker::class
                                ),
                            ])
                        ),
                ])
            );
    }
}