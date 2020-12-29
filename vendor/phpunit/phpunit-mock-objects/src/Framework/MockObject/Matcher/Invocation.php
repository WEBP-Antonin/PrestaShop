<?php

namespace MolliePrefix;

/*
 * This file is part of the PHPUnit_MockObject package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Interface for classes which matches an invocation based on its
 * method name, argument, order or call count.
 *
 * @since Interface available since Release 1.0.0
 */
interface PHPUnit_Framework_MockObject_Matcher_Invocation extends \MolliePrefix\PHPUnit_Framework_SelfDescribing, \MolliePrefix\PHPUnit_Framework_MockObject_Verifiable
{
    /**
     * Registers the invocation $invocation in the object as being invoked.
     * This will only occur after matches() returns true which means the
     * current invocation is the correct one.
     *
     * The matcher can store information from the invocation which can later
     * be checked in verify(), or it can check the values directly and throw
     * and exception if an expectation is not met.
     *
     * If the matcher is a stub it will also have a return value.
     *
     * @param PHPUnit_Framework_MockObject_Invocation $invocation Object containing information on a mocked or stubbed method which was invoked
     *
     * @return mixed
     */
    public function invoked(\MolliePrefix\PHPUnit_Framework_MockObject_Invocation $invocation);
    /**
     * Checks if the invocation $invocation matches the current rules. If it does
     * the matcher will get the invoked() method called which should check if an
     * expectation is met.
     *
     * @param PHPUnit_Framework_MockObject_Invocation $invocation Object containing information on a mocked or stubbed method which was invoked
     *
     * @return bool
     */
    public function matches(\MolliePrefix\PHPUnit_Framework_MockObject_Invocation $invocation);
}
/*
 * This file is part of the PHPUnit_MockObject package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Interface for classes which matches an invocation based on its
 * method name, argument, order or call count.
 *
 * @since Interface available since Release 1.0.0
 */
\class_alias('MolliePrefix\\PHPUnit_Framework_MockObject_Matcher_Invocation', 'PHPUnit_Framework_MockObject_Matcher_Invocation', \false);
