<?php

namespace Vendor\CategoryTextAttribute2\Setup;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        //Category Attribute Create Script
        $eavSetup->addAttribute(
            Category::ENTITY,
            'category_short_description',
            [
                'group' => 'autosmart_category_fields',
                'label' => 'Category Short Description',
                'type' => 'text',
                'input' => 'textarea',
                'required' => false,
                'sort_order' => 1,
                'global' => Attribute::SCOPE_STORE,
                'used_in_product_listing' => true,
                'visible_on_front' => false
            ]
        );

        $setup->endSetup();
    }
}
