<?php

/*
 * This file is part of the TeckHouseAnalyticsBundle package.
 *
 * (c) TeckHouse <http://www.teckouse.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TeckHouse\AnalyticsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use TeckHouse\AnalyticsBundle\DependencyInjection\Compiler\AnalyticsCompilerPass;

/**
 * @author Mauro Foti <m.foti@teckouse.com>
 */
class TeckHouseAnalyticsBundle extends Bundle
{

//    public function build(ContainerBuilder $container)
//    {
//        parent::build($container);
////        $container->addCompilerPass(new AnalyticsCompilerPass());
//    }
    
}
