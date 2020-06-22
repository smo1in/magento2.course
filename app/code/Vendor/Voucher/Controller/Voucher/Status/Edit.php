<?php

namespace Vendor\Voucher\Controller\Voucher\Status;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /** @var Http */
    protected $_request;

    /** @var PageFactory */
    protected $_pageFactory;

    /** @var Registry */
    protected $_coreRegistry;

    public function __construct(
        Context $context,
        Http $request,
        PageFactory $pageFactory,
        Registry $coreRegistry
    ) {
        $this->_request = $request;
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');
        $this->_coreRegistry->register('edit_record_id', $id);
        return $this->_pageFactory->create();
    }
}
