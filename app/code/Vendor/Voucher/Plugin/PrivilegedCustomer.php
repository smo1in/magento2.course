<?php

namespace Vendor\Voucher\Plugin;

use Exception;
use Magento\Customer\Model\CustomerFactory as CustomerModelFactory;
use Vendor\Voucher\Model\VoucherManagement as Subject;


class PrivilegedCustomer
{

    /**@var CustomerModelFactory */
    private $customerModelFactory;

    /**
     * @param CustomerModelFactory $customerModelFactory
     */

    public function __construct(CustomerModelFactory $customerModelFactory)
    {
        $this->customerModelFactory = $customerModelFactory;
    }

    /**
     * @param Subject $subject
     * @param $id
     * @throws Exception
     */
    public function beforeCreateVoucher(Subject $subject, $id)
    {

        $customerGroupId = $this->customerModelFactory->create()->load($id)->getGroupId();

        if (!$customerGroupId = 4) {
            throw new Exception("Customer is not in a privileged group");
        }

    }
}






