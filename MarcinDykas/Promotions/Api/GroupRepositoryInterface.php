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
     * GroupInterface save
     *
     * @param GroupInterface $group
     * @return \MarcinDykas\Promotions\Api\Data\GroupInterface
     */
    public function save(GroupInterface $group): GroupInterface;

    /**
     * GroupInterface get by ID
     *
     * @param int $groupId
     * @return \MarcinDykas\Promotions\Api\Data\GroupInterface
     */
    public function getById(int $groupId): GroupInterface;

    /**
     * GroupInterface delete
     *
     * @param GroupInterface $group
     * @return void
     */
    public function delete(GroupInterface $group): void;

    /**
     * GroupInterface delete by ID
     *
     * @param int $groupId
     * @return void
     */
    public function deleteById(int $groupId): void;

    /**
     * GroupInterface get list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \MarcinDykas\Promotions\Api\Data\GroupInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;
}
