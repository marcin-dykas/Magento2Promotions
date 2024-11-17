<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use MarcinDykas\Promotions\Api\Data\GroupInterface;
use MarcinDykas\Promotions\Model\ResourceModel\Group as ResourceGroup;

/**
 * Model class for Promotion Group entity.
 */
class Group extends AbstractExtensibleModel implements GroupInterface
{
    /**
     * Model init
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceGroup::class);
    }

    /**
     * Get group ID.
     *
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        $groupId = $this->getData(self::FIELD_GROUP_ID);
        return $groupId !== null ? (int)$groupId : null;
    }

    /**
     * Get group name.
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
     * Set group ID.
     *
     * @param int $groupId
     * @return GroupInterface
     */
    public function setGroupId(int $groupId): GroupInterface
    {
        if ($this->getGroupId()) {
            throw new \RuntimeException('The group ID was already set and cannot be changed.');
        }
        return $this->setData(self::FIELD_GROUP_ID, $groupId);
    }

    /**
     * Set group name.
     *
     * @param string $name
     * @return GroupInterface
     */
    public function setName(string $name): GroupInterface
    {
        return $this->setData(self::FIELD_NAME, $name);
    }

    /**
     * Set creation timestamp.
     *
     * @param string $createdAt
     * @return GroupInterface
     */
    public function setCreatedAt(string $createdAt): GroupInterface
    {
        return $this->setData(self::FIELD_CREATED_AT, $createdAt);
    }

    /**
     * Set update timestamp.
     *
     * @param string $updatedAt
     * @return GroupInterface
     */
    public function setUpdatedAt(string $updatedAt): GroupInterface
    {
        return $this->setData(self::FIELD_UPDATED_AT, $updatedAt);
    }
}
