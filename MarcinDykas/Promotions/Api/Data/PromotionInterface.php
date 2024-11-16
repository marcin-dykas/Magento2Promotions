<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Api\Data;

/**
 * Interface for Promotion entity.
 */
interface PromotionInterface
{
    /**
     * Data fields
     */
    public const FIELD_PROMOTION_ID = 'promotion_id';
    public const FIELD_GROUP_ID = 'group_id';
    public const FIELD_NAME = 'name';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    /**
     * Get Promotion ID
     *
     * @return int|null
     */
    public function getPromotionId(): ?int;

    /**
     * Get Group ID
     *
     * @return int
     */
    public function getGroupId(): int;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Promotion ID
     *
     * @param int $promotionId
     * @return self
     */
    public function setPromotionId(int $promotionId): self;

    /**
     * Set Group ID
     *
     * @param int $groupId
     * @return self
     */
    public function setGroupId(int $groupId): self;

    /**
     * Set Name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt): self;

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     * @return self
     */
    public function setUpdatedAt(string $updatedAt): self;
}
