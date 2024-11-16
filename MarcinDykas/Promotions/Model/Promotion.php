<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use MarcinDykas\Promotions\Api\Data\PromotionInterface;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion as PromotionResource;

/**
 * Model class for Promotion entity.
 */
class Promotion extends AbstractExtensibleModel implements PromotionInterface
{
    protected function _construct(): void
    {
        $this->_init(PromotionResource::class);
    }

    /**
     * Get promotion ID.
     *
     * @return int|null
     */
    public function getPromotionId(): ?int
    {
        $promotionId = $this->getData(self::FIELD_PROMOTION_ID);
        return $promotionId !== null ? (int)$promotionId : null;
    }

    /**
     * Get parent group ID.
     *
     * @return int
     */
    public function getGroupId(): int
    {
        return (int)$this->getData(self::FIELD_GROUP_ID);
    }

    /**
     * Get promotion name.
     *
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->getData(self::FIELD_NAME);
    }

    /**
     * Get creation timestamp.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string)$this->getData(self::FIELD_CREATED_AT);
    }

    /**
     * Get update timestamp.
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string)$this->getData(self::FIELD_UPDATED_AT);
    }

    /**
     * Set promotion ID.
     *
     * @param int $promotionId
     * @return PromotionInterface
     */
    public function setPromotionId(int $promotionId): PromotionInterface
    {
        return $this->setData(self::FIELD_PROMOTION_ID, $promotionId);
    }

    /**
     * Set parent group ID.
     *
     * @param int $groupId
     * @return PromotionInterface
     */
    public function setGroupId(int $groupId): PromotionInterface
    {
        return $this->setData(self::FIELD_GROUP_ID, $groupId);
    }

    /**
     * Set promotion name.
     *
     * @param string $name
     * @return PromotionInterface
     */
    public function setName(string $name): PromotionInterface
    {
        return $this->setData(self::FIELD_NAME, $name);
    }

    /**
     * Set creation timestamp.
     *
     * @param string $createdAt
     * @return PromotionInterface
     */
    public function setCreatedAt(string $createdAt): PromotionInterface
    {
        return $this->setData(self::FIELD_CREATED_AT, $createdAt);
    }

    /**
     * Set update timestamp.
     *
     * @param string $updatedAt
     * @return PromotionInterface
     */
    public function setUpdatedAt(string $updatedAt): PromotionInterface
    {
        return $this->setData(self::FIELD_UPDATED_AT, $updatedAt);
    }
}
