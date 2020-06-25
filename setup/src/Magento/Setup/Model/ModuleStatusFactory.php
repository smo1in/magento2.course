<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Model;

use Magento\Framework\Module\Status;

/**
 * Class ModuleStatusFactory creates instance of Voucher
 */
class ModuleStatusFactory
{
    /**
     * @var ObjectManagerProvider
     */
    private $objectManagerProvider;

    /**
     * Constructor
     *
     * @param ObjectManagerProvider $objectManagerProvider
     */
    public function __construct(ObjectManagerProvider $objectManagerProvider)
    {
        $this->objectManagerProvider = $objectManagerProvider;
    }

    /**
     * Creates Voucher object
     *
     * @return Status
     */
    public function create()
    {
        return $this->objectManagerProvider->get()->get(\Magento\Framework\Module\Status::class);
    }
}
