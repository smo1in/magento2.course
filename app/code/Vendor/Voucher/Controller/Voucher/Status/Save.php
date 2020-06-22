<?php

namespace Vendor\Voucher\Controller\Voucher\Status;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Vendor\Voucher\Model\VoucherStatusFactory;

class Save extends Action
{
    /** @var VoucherStatusFactory */
    private $voucherStatusFactory;

    public function __construct(
        Context $context,
        VoucherStatusFactory $voucherStatusFactory
    ) {
        $this->voucherStatusFactory = $voucherStatusFactory;

        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface
     * @throws AlreadyExistsException
     */

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $voucherStatus = $this->voucherStatusFactory->create();

            if ($input['id']) {
                $voucherStatus->load($input['id']);
                $voucherStatus->addData($input);
                $voucherStatus->setId($input['id']);
                $voucherStatus->save();
            } else {
                $voucherStatus->setData($input)->save();
            }

            return $this->_redirect('voucher/voucher_status/index');
        }
    }
}
