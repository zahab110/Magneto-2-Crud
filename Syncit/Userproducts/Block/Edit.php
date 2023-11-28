<?php

namespace Syncit\Userproducts\Block;

use Magento\Framework\View\Element\Template;

class Edit extends Template
{
    protected $_sanitize;
    protected $_request;
    protected $customDataRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Escaper $escapeHtml,
        \Magento\Framework\App\Request\Http $request,
        \Syncit\Userproducts\Model\Preview $customDataRepository,
        array $data = []
    ) {
        $this->_sanitize = $escapeHtml;
        $this->_request = $request;
        $this->customDataRepository = $customDataRepository;
        parent::__construct($context, $data);
    }

    public function editProduct()
    {
        return __('Edit product');
    }

    public function getId()
    {
        $urlId = $this->_request->getParam('id');

		return $urlId;
    }

	public function getName()
    {
        $fieldName = 'name';
        $id = $this->getId();
        $customData = $this->customDataRepository->load($id);
        $name = $customData->getData($fieldName);
        return $name;
    }

	public function getPrice()
	{
		$fieldName = 'price';
		$id = $this->getId();
		$customData = $this->customDataRepository->load($id);
		$price = $customData->getData($fieldName);
		return $price;
	}
	// public function getImage()
	// {
	// 	$fieldImage = 'image';
	// 	$id = $this->getId();
	// 	$customData = $this->customDataRepository->load($id);
	// 	$pic = $customData->getData($fieldImage);
	// 	return $pic;
	// }
	public function getImagePreview()
	{$fieldImage = 'image';
		$id = $this->getId();
		$customData = $this->customDataRepository->load($id);
		$pic = $customData->getData($fieldImage);
		return $pic;
	}
	


	

    public function getFormAction()
    {
        return $this->getUrl('userproducts/index/update', ['id' => $this->getId(), '_secure' => true]);
    }
}
