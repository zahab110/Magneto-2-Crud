<?php

namespace Syncit\Userproducts\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Syncit\Userproducts\Api\Data\ProductlistInterface;

/**
 * Class View
 * @package Syncit\Userproducts\Model
 */
class Preview extends AbstractModel implements ProductlistInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'syncit_userproducts_preview';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Syncit\Userproducts\Model\ResourceModel\Preview');
    }

    /**
     * Get Image
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->getData(ProductlistInterface::IMAGE);
    }

    /**
     * Get Price
     *
     * @return float|null
     */
    public function getPrice()
    {
        return $this->getData(ProductlistInterface::PRICE);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(ProductlistInterface::CREATED_AT);
    }

    /**
     * Get Entity ID
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(ProductlistInterface::ENTITY_ID);
    }

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set Image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        return $this->setData(ProductlistInterface::IMAGE, $image);
    }

    /**
     * Set Price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(ProductlistInterface::PRICE, $price);
    }


    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(ProductlistInterface::NAME, $name);
    }


    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(ProductlistInterface::CREATED_AT, $createdAt);
    }

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(ProductlistInterface::ENTITY_ID, $entityId);
    }
}
