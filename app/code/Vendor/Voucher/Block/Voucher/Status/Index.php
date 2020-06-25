<?php

namespace Vendor\Voucher\Block\Voucher\Status;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vendor\Voucher\Model\ResourceModel\VoucherStatus\Collection;
use Vendor\Voucher\Model\ResourceModel\VoucherStatus\CollectionFactory;

class Index extends Template
{
    /** @var CollectionFactory */
    private $_voucherStatusCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $voucherStatusCollectionFactory
    ) {
        parent::__construct($context);

        $this->_voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
    }

    /**
     * @return Collection
     */
    public function getResult()
    {
        return $this->_voucherStatusCollectionFactory->create();
    }
}
