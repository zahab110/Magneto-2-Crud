<?php

namespace Syncit\Userproducts\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $storeManager;
    protected $formKeyValidator;
    protected $_filter;
    protected $_storeManager;
    protected $_fileUploaderFactory;
    protected $_filesystem;
    protected $_errors = null;
    private $serializer;
    protected $productFactory;
    protected $productRepository;
    protected $stockRegistry;
    public $user_id;
    protected $_sanitize;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem,
        SerializerInterface $serializer,
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\Escaper $escapeHtml
    ) {
        $this->storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->messageManager = $context->getMessageManager();
        $this->_productFactory = $productFactory;
        $this->_filter = $filter;
        $this->_storeManager = $storeManager;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
        $this->serializer = $serializer;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->user_id = $session;
        $this->_sanitize = $escapeHtml;
        parent::__construct($context);
    }

    public function execute()
    {
        // Sanitize with allowed tags
        $availableTags = "<p>,</p>,<h1>,</h1>,<b>,</b>,<h2>,</h2>,<h3>,</h3>,<pre>,</pre>,<span>,</span>,
            <blockquote>,</blockquote>,<ul>,</ul>,<ol>,</ol>,<li>,</li>,<s>,</s>,<em>,</em>,<a>,</a>,<table>,
            </table>,<tbody>,</tbody>,<tr>,</tr>,<td>,</td>";
    
        try {
            $resultRedirect = $this->resultRedirectFactory->create();
            $name = $this->_sanitize->escapeHtml($this->getRequest()->getParam('name'));
            $price = $this->getRequest()->getParam('price');
            $image = $this->getRequest()->getFiles()->image['name'];
        
            $dataExample = $this->_objectManager->create('Syncit\Userproducts\Model\Preview');
            $dataExample->setName($name);  // Set the 'name' column
            $dataExample->setPrice($price); // Set the 'price' column
        
            if (!empty($image)) {
                $imgArray = explode('.', $image);
                $fileExt = end($imgArray); // Get the file extension from the original image name
                $image = $image; // Keep the original image name
            
                // Upload in the images folder
                $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'jp2']);
                $uploader->setAllowRenameFiles(false); // Disable renaming of files
                $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/');
                $result = $uploader->save($path, $image);
            }
            
            $dataExample->setImage($image);
            $dataExample->save();
    
            $this->messageManager->addSuccess(__('You have successfully added a product.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('An error occurred while saving the product: ' . $e->getMessage()));
        }
    
        return $resultRedirect->setPath('*/*/index');
    }
    
}
