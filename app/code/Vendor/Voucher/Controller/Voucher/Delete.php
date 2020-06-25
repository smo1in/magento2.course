<?php

namespace Vendor\Voucher\Controller\Voucher;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Vendor\Voucher\Api\Data\VoucherInterfaceFactory;
use Vendor\Voucher\Model\ResourceModel\Voucher;

class Delete extends Action
{
    /** @var Http */
    protected $_request;

    /** @var VoucherInterfaceFactory */
    protected $_voucherFactory;

    /** @var Voucher */
    protected $_voucherResource;

    public function __construct(
        Context $context,
        Http $request,
        VoucherInterfaceFactory $voucherFactory,
        Voucher $voucherResource
    ) {
        $this->_request = $request;
        $this->_voucherFactory = $voucherFactory;
        $this->_voucherResource = $voucherResource;

        return parent::__construct($context);
    }

    public function execute()
    {
        $voucher = $this->_voucherFactory->create();
        $this->_voucherResource->load($voucher, $this->_request->getParam('id'))->delete($voucher);
        return $this->_redirect('voucher/voucher/index');
    }
}
