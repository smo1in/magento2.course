<?php

namespace Vendor\Voucher\Block\Voucher\Status;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context as Context;
use Vendor\Voucher\Model\VoucherStatus;
use Vendor\Voucher\Model\VoucherStatusFactory as VoucherStatusFactory;

class Edit extends Template
{
    /** @var VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Vendor\Voucher\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    /** @var Registry */
    private $coreRegistry;

    public function __construct(
        Context $context,
        VoucherStatusFactory $voucherStatusFactory,
        \Vendor\Voucher\Model\ResourceModel\VoucherStatus $voucherStatusResource,
        Registry $coreRegistry
    )
    {
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;
        $this->coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }

    /**
     * @return VoucherStatus
     */
    public function getRecord()
    {
        $id = $this->coreRegistry->registry('edit_record_id');
        $this->coreRegistry->unregister('edit_record_id');

        $voucherStatus = $this->voucherStatusFactory->create();
        $this->voucherStatusResource->load($voucherStatus, $id);

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
