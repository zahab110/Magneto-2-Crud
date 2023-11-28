<?php

namespace Syncit\Userproducts\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Syncit\Userproducts\Model\ResourceModel\Preview\CollectionFactory;

class Productlist extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_customCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CollectionFactory $customCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $customCollectionFactory,
        array $data = []
    ) {
        $this->_customCollectionFactory = $customCollectionFactory;
        parent::__construct($context, $data);
    }

            /**
         * @return Preview[]
         */
        public function getAllProducts()
        {
            try {
                
                /** @var CollectionFactory $customCollectionFactory */
                $customCollectionFactory = $this->_customCollectionFactory->create();
                $customCollectionFactory->addFieldToSelect('*')->load();
                // echo $customCollectionFactory->getSelect();
                return $customCollectionFactory->getItems();
            } catch (\Exception $e) {
                $this->_logger->error($e->getMessage());
                return [];
            }
        }

    /**
     * For a given product, returns its url
     * @param CollectionFactory $dataExample
     * @return string
     */
    public function getProductUrl($entityId) {
         return $this->getUrl('userproducts/index/view/'.$entityId, ['_secure' => true]);
    }
}
