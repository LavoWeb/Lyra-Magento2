<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model\Logger\Handler;

class Lyra extends \Magento\Framework\Logger\Handler\Base
{

    /**
     *
     * @var string
     */
    protected $fileName = '/var/log/lyra.log';

    /**
     *
     * @var int
     */
    protected $loggerType = \Monolog\Logger::INFO;
}
