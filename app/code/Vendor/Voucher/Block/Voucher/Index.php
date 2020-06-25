<?php

namespace Vendor\Voucher\Block\Voucher;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vendor\Voucher\Model\ResourceModel\Voucher\CollectionFactory;

class Index extends Template
{
    /** @var CollectionFactory */
    private $_voucherCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $voucherCollectionFactory
    ) {
        parent::__construct($context);

        $this->_voucherCollectionFactory = $voucherCollectionFactory;
    }

    /**
     * @return AbstractDb|AbstractCollection
     */
    public function getResult()
    {
        return $this->_voucherCollectionFactory->create();
    }
}
