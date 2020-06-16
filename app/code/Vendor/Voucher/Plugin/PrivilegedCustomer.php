<?php

namespace Vendor\Voucher\Plugin;

use Exception;
use Magento\Customer\Model\CustomerFactory as CustomerModelFactory;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use Vendor\Voucher\Model\VoucherManagement as Subject;

class PrivilegedCustomer
{
    /**@var CustomerModelFactory */
    private $customerModelFactory;

    /** @var GroupCollectionFactory */
    private $groupCollectionFactory;

    public function __construct(
        CustomerModelFactory $customerModelFactory,
        GroupCollectionFactory $groupCollectionFactory
    ) {
        $this->customerModelFactory = $customerModelFactory;
        $this->groupCollectionFactory = $groupCollectionFactory;
    }

    /**
     * @param Subject $subject
     * @param int $customer_Id
     * @return int
     * @throws Exception
     */
    public function beforeCreateVoucher(Subject $subject, int $customer_id)
    {
        $group = $this->groupCollectionFactory->create()
            ->addFieldToFilter('customer_group_code', 'Privileged Customers')
            ->getFirstItem();

        $customer = $this->customerModelFactory->create()->load($customer_id);

        if ($group->getId() != $customer->getGroupId()) {
            throw new Exception("Customer is not in a privileged group");
        }

    }
}
