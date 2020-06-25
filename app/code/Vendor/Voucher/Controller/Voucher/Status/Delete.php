<?php

namespace Vendor\Voucher\Controller\Voucher\Status;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\App\Request\Http;
use Vendor\Voucher\Model\VoucherStatusFactory;

class Delete extends Action
{
    /** @var Http */
    protected $_request;

    /** @var VoucherStatusFactory */
    protected $_voucherStatusFactory;

    public function __construct(
        Context $context,
        Http $request,
        VoucherStatusFactory $voucherStatusFactory
    )
    {
        $this->_request = $request;
        $this->_voucherStatusFactory = $voucherStatusFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->_request->getParam('id');
        $voucherStatus = $this->_voucherStatusFactory->create()->setId($id)->delete();;
        return $this->_redirect('voucher/voucher_status/index');
    }
}
