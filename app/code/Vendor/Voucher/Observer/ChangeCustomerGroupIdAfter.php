<?php

namespace Vendor\Voucher\Observer;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Group;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Vendor\Voucher\Model\ResourceModel\Voucher as VoucherResource;
use Vendor\Voucher\Model\ResourceModel\Voucher\Collection;
use Vendor\Voucher\Model\ResourceModel\Voucher\CollectionFactory as VoucherCollectionFactory;

use Vendor\Voucher\Model\Voucher;

class ChangeCustomerGroupIdAfter implements ObserverInterface
{
    private $groupCollectionFactory;
    private $voucherCollectionFactory;
    private $voucherResource;

    public function __construct(
        GroupCollectionFactory $groupCollectionFactory,
        VoucherCollectionFactory $voucherCollectionFactory,
        VoucherResource $voucherResource
    ) {
        $this->GroupCollectionFactory = $groupCollectionFactory;
        $this->voucherCollectionFactory = $voucherCollectionFactory;
        $this->voucherResource = $voucherResource;
    }

    public function execute(Observer $observer)
    {
        /** @var CustomerInterface $customer */
        $customer = $observer->getData('customer');

        /** @var Group $group */
        $group = $this->groupCollectionFactory->create()
            ->addFieldToFilter('customer_group_code', 'Privileged Customers')
            ->getFirstItem();

        if ($customer->getGroupId() != $group->getId()) {

            /** @var Collection $voucherCollection */
            $voucherCollection = $this->voucherCollectionFactory->create();

            /** @var Voucher $voucher */
            foreach ($voucherCollection->filterByCustomerId($customer->getId())->load() as $voucher) {
            $voucher->delete();
            }
        }
    }
}
