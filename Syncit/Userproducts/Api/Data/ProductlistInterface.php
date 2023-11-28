<?php
namespace Syncit\Userproducts\Api\Data;

interface ProductlistInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID            = 'entity_id';
    const NAME                 = 'name';
    const IMAGE                 = 'image';
    const PRICE               = 'price';
    const CREATED_AT            = 'created_at';
        /**#@-*/




    /**
     * Get Image
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Get Price
     *
     * @return float|null
     */
    public function getPrice();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get Entity ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set Image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image);

     /**
     * Set Name
     *
     * @param string $image
     * @return $this
     */
    public function setName($image);

    /**
     * Set Price
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);
}