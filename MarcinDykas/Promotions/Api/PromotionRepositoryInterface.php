<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

namespace MarcinDykas\Promotions\Api;

use MarcinDykas\Promotions\Api\Data\PromotionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Repository interface for managing Promotion entities.
 */
interface PromotionRepositoryInterface
{
    /**
     * @param PromotionInterface $promotion
     * @return PromotionInterface
     */
    public function save(PromotionInterface $promotion): PromotionInterface;

    /**
     * @param int $promotionId
     * @return PromotionInterface
     */
    public function getById(int $promotionId): PromotionInterface;

    /**
     * @param PromotionInterface $promotion
     * @return void
     */
    public function delete(PromotionInterface $promotion): void;

    /**
     * @param int $promotionId
     * @return void
     */
    public function deleteById(int $promotionId): void;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PromotionInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;
}
