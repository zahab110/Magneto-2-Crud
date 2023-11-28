<?php

namespace Syncit\Userproducts\Block;

use Magento\Framework\App\Filesystem\DirectoryList;

class Preview extends \Magento\Framework\View\Element\Template
{
    /**
     * {@inheritdoc}
     */
    // User id 

    /**
     * @var Session
     */
    public $user_id;
    protected $productFactory;
    protected $_productCollectionFactory;
    protected $_storeManager;
    protected $_filesystem;
    protected $_sanitize;
    protected $_request;
    protected $customDataRepository;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $session,
        array $data,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Escaper $escapeHtml,
        \Magento\Framework\App\Request\Http $request,
        \Syncit\Userproducts\Model\Preview $customDataRepository

    ) {
        parent::__construct($context, $data);
        $this->user_id = $session;
        $this->productFactory = $productFactory;
        $this->_productCollectionFactory =  $productCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_sanitize = $escapeHtml;
        $this->_request = $request;
        $this->customDataRepository = $customDataRepository;
    }


    public function getId()
    {

        $productId = $this->getRequest()->getParam('id');
        // echo $productId;
        // die();
        return $productId;
    }
    // Get single product field
    public function getProduct()
    {

        $fieldName = 'name';
        $id = $this->getId();
        $customData = $this->customDataRepository->load($id);
        $name = $customData->getData($fieldName);
        return $name;
    }
    //  public function getAllProducts()
    // {
    //     //get product collection
    //     $collection = $this->_productCollectionFactory->create();
    //     $collection->addAttributeToFilter('added_by_customer_id',$this->getUserId());
    //     $collection->addAttributeToSelect('*');
    //     $collection->setPageSize(100); // fetching 100 products
    //     return $collection;

    // }


    public function getPrice()
    {
        $fieldName = 'price';
        $id = $this->getId();
        $customData = $this->customDataRepository->load($id);
        $price = $customData->getData($fieldName);
        return $price;
    }


    public function getImagePreview()
    {
        $fieldImage = 'image';
        $id = $this->getId();
        $customData = $this->customDataRepository->load($id);
        $pic = $customData->getData($fieldImage);
        return $pic;
    }



    // public function getUserId(){
    //     return $this->user_id->getCustomerId();
    // }



}
