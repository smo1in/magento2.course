<?php

namespace Vendor\Voucher\Controller\Voucher\Status;

use Magento\Customer\Model\Session as Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /** @var PageFactory */
    protected $_pageFactory;
    /** @var Session */
    private $_session;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $session
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_session = $session;
        return parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        if ($this->_session->isLoggedIn()) {
            return $this->_pageFactory->create();
        } else {
            $this->_redirect('customer/account/login/');
        }
    }
}
