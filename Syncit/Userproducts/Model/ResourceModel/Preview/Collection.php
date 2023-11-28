<?php
namespace Syncit\Userproducts\Model\ResourceModel\Preview;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Syncit\Userproducts\Model\Preview::class, \Syncit\Userproducts\Model\ResourceModel\Preview::class);
    }
}