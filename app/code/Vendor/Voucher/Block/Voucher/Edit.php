<?php

namespace Vendor\Voucher\Block\Voucher;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as Context;
use Vendor\Voucher\Api\Data\VoucherInterfaceFactory;
use Vendor\Voucher\Model\ResourceModel\Voucher;

class Edit extends Template
{
    /** @var VoucherInterfaceFactory */
    private $_voucherFactory;

    /** @var Voucher */
    private $_voucherResource;

    /** @var Registry */
    private $_coreRegistry;

    public function __construct(
        Context $context,
        VoucherInterfaceFactory $voucherFactory,
        Voucher $voucherResource,
        Registry $coreRegistry
    ) {
        parent::__construct($context);

        $this->_voucherFactory = $voucherFactory;
        $this->_voucherResource = $voucherResource;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @return Voucher
     */
    public function getRecord()
    {
        $id = $this->_coreRegistry->registry('edit_record_id');
        $this->_coreRegistry->unregister('edit_record_id');

        $voucher = $this->_voucherFactory->create();
        $this->_voucherResource->load($voucher, $id);

        return $voucher;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('voucher/voucher/save');
    }
}
