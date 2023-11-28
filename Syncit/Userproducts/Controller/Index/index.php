<?php

namespace Syncit\Userproducts\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_sessionFactory;
 
    public function __construct(
        Context $context, 
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\SessionFactory $sessionFactory
    
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_sessionFactory = $sessionFactory ;
        parent::__construct($context);
    }
     
        public function execute()
        {
        
            $resultPage = $this->_resultPageFactory->create();
            return $resultPage;
          
        }
   
    }
   

