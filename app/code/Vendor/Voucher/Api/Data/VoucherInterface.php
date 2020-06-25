<?php


namespace Vendor\Voucher\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface VoucherInterface extends ExtensibleDataInterface
{
    /**
     * @return \Vendor\Voucher\Api\Data\VoucherExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Vendor\Voucher\Api\Data\VoucherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Vendor\Voucher\Api\Data\VoucherExtensionInterface $extensionAttributes
    );
}
