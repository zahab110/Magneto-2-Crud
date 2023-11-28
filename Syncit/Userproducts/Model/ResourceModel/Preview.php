<?php

namespace Syncit\Userproducts\Model\ResourceModel;


class Preview extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        
        $this->_init("syncit_userproducts","entity_id");
    }
}