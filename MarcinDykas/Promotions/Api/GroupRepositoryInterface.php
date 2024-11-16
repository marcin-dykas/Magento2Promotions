<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Api;

use MarcinDykas\Promotions\Api\Data\GroupInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Repository interface for managing Promotion Group entities.
 */
interface GroupRepositoryInterface
{
    /**
     * @param GroupInterface $group
     * @return GroupInterface
     */
    public function save(GroupInterface $group): GroupInterface;

    /**
     * @param int $groupId
     * @return GroupInterface
     */
    public function getById(int $groupId): GroupInterface;

    /**
     * @param GroupInterface $group
     * @return void
     */
    public function delete(GroupInterface $group): void;

    /**
     * @param int $groupId
     * @return void
     */
    public function deleteById(int $groupId): void;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return GroupInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;
}
