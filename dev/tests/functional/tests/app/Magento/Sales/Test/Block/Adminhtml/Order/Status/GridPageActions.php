<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Sales\Test\Block\Adminhtml\Order\Status;

/**
 * Class GridPageActions
 * Grid page actions block on OrderStatus index page
 */
class GridPageActions extends \Magento\Backend\Test\Block\GridPageActions
{
    /**
     * "Assign Voucher To state" button
     *
     * @var string
     */
    protected $assignButton = '#assign';

    /**
     * Click on "Assign Voucher To State" button
     *
     * @return void
     */
    public function assignStatusToState()
    {
        $this->_rootElement->find($this->assignButton)->click();
    }
}
