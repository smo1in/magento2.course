<?php

namespace Vendor\Voucher\Setup\Patch\Data;

use Magento\Customer\Model\GroupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class customerGroup implements DataPatchInterface
{
    private $moduleDataSetup;
    private $groupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param GroupFactory $groupFactory
     */
    public function __construct(
        GroupFactory $groupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->groupFactory = $groupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->groupFactory->create()
            ->setCode('Privileged Customers')
            ->setTaxClassId(3)
            ->save();

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function revert()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
