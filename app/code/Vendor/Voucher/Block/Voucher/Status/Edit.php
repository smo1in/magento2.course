<?php

namespace Vendor\Voucher\Block\Voucher\Status;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as Context;
use Vendor\Voucher\Model\ResourceModel\VoucherStatus;
use Vendor\Voucher\Model\VoucherStatusFactory as VoucherStatusFactory;

class Edit extends Template
{
    /** @var VoucherStatusFactory */
    private $_voucherStatusFactory;

    /** @var VoucherStatus */
    private $_voucherStatusResource;

    /** @var Registry */
    private $_coreRegistry;

    public function __construct(
        Context $context,
        VoucherStatusFactory $voucherStatusFactory,
        VoucherStatus $voucherStatusResource,
        Registry $coreRegistry
    )
    {
        $this->_voucherStatusFactory = $voucherStatusFactory;
        $this->_voucherStatusResource = $voucherStatusResource;
        $this->coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }

    /**
     * @return VoucherStatus
     */
    public function getRecord()
    {
        $id = $this->_coreRegistry->registry('edit_record_id');
        $this->_coreRegistry->unregister('edit_record_id');

        $voucherStatus = $this->_voucherStatusFactory->create();
        $this->_voucherStatusResource->load($voucherStatus, $id);

        return $voucherStatus;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('voucher/voucher_status/save');
    }
}
