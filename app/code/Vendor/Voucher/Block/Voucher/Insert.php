<?php

namespace Vendor\Voucher\Block\Voucher;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as Context;

class Insert extends Template
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
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
        return $this->getUrl('voucher/voucher/save');
    }
}
