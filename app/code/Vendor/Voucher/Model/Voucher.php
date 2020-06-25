<?php


namespace Vendor\Voucher\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use Vendor\Voucher\Api\Data\VoucherInterface;
use Vendor\Voucher\Model\ResourceModel\Voucher as ResourceModel;

class Voucher extends AbstractExtensibleModel implements IdentityInterface, VoucherInterface
{
    const CACHE_TAG = 'voucher';

    protected $_cacheTag = 'voucher';

    protected $_eventPrefix = 'voucher';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        return [];
    }


    public function setCustomerId($customer_id)
    {
        return $this->setData('customer_id', $customer_id);
    }

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    public function setStatusId($status_id)
    {
        return $this->setData('status_id', $status_id);
    }

    public function getStatusId()
    {
        return $this->getData('status_id');
    }

    public function setVoucherCode($voucher_code)
    {
        return $this->setData('voucher_code', $voucher_code);
    }

    public function getVoucherCode()
    {
        return $this->getData('voucher_code');
    }

    /**
     * @return  \Vendor\Voucher\Api\Data\VoucherExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @param \Vendor\Voucher\Api\Data\VoucherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Vendor\Voucher\Api\Data\VoucherExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
