<?php

namespace Syncit\Userproducts\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Syncit\Userproducts\Model\Preview;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $extensionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Preview $extensionFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->extensionFactory = $extensionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $productId = $this->getRequest()->getParam('id');

        try {
            $product = $this->extensionFactory->load($productId);
            if ($product->getId()) {
                $product->delete();
                $this->messageManager->addSuccessMessage(__("Record deleted successfully."));
            } else {
                $this->messageManager->addErrorMessage(__("Record not found."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Error: " . $e->getMessage()));
        }

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
