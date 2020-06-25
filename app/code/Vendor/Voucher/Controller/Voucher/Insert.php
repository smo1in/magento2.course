<?php

namespace Vendor\Voucher\Controller\Voucher;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Insert extends Action
{
    /** @var PageFactory */
    private $_pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
