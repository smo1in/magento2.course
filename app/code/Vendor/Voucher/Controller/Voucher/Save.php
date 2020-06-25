<?php

namespace Vendor\Voucher\Controller\Voucher;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vendor\Voucher\Model\ResourceModel\Voucher as VoucherResource;
use Vendor\Voucher\Model\VoucherFactory as Voucher;

class Save extends Action
{

    /**@var VoucherResource */
    private $_voucherResource;

    /**@var Voucher */
    private $_voucher;

    public function __construct(
        Context $context,
        VoucherResource $voucherResource,
        Voucher $voucher
    ) {
        parent::__construct($context);

        $this->_voucherResource = $voucherResource;
        $this->_voucher = $voucher;
    }

    public function execute()
    {
        $this->getRequest()->isPost();
        $post = $this->getRequest()->getPostValue();

        if (!empty($post['id'])) {
            $voucherEdit = $this->_voucher->create();
            $this->_voucherResource->load($voucherEdit, $post['id']);
            $voucherEdit->addData($post)->setEntityId($post['id']);
            $this->_voucherResource->save($voucherEdit);
        } else {
            $voucherNew = $this->_voucher->create();
            $voucherNew->setCustomerId($post['customer_id'])
                ->setStatusId($post['status_id'])
                ->setVoucherCode($post['voucher_code']);
            $this->_voucherResource->save($voucherNew);
        }

        return $this->_redirect('voucher/voucher/index');
    }
}
