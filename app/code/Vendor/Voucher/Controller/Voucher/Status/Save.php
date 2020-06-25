<?php

namespace Vendor\Voucher\Controller\Voucher\Status;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Vendor\Voucher\Model\VoucherStatusFactory;

class Save extends Action
{
    /** @var VoucherStatusFactory */
    protected $_voucherStatusFactory;

    public function __construct(
        Context $context,
        VoucherStatusFactory $voucherStatusFactory
    ) {
        $this->_voucherStatusFactory = $voucherStatusFactory;

        return parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPostValue();
            $voucherStatus = $this->_voucherStatusFactory->create();

            if (!empty($post['id'])) {
                $voucherStatus->load($post['id']);
                $voucherStatus->addData($post);
                $voucherStatus->setId($post['id']);
                $voucherStatus->save();
            } else {
                $voucherStatus->setData($post)->save();
            }

            return $this->_redirect('voucher/voucher_status/index');
        }
    }
}
