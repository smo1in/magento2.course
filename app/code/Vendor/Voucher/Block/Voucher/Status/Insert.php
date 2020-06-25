<?php

namespace Vendor\Voucher\Block\Voucher\Status;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as Context;

class Insert extends Template
{
    public function __construct(
        Context $context
    ) {
        return parent::__construct($context);
    }

    /**
     * @return null
     */
    public function getRecord()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('voucher/voucher_status/save');
    }
}
