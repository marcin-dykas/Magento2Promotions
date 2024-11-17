<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use MarcinDykas\Promotions\Api\Data\PromotionInterface;
use MarcinDykas\Promotions\Api\PromotionRepositoryInterface;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion as PromotionResource;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion\CollectionFactory as PromotionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use MarcinDykas\Promotions\Model\PromotionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Repository for Promotion entity.
 */
class PromotionRepository implements PromotionRepositoryInterface
{
    /**
     * @param PromotionResource $resource
     * @param \MarcinDykas\Promotions\Model\PromotionFactory $promotionFactory
     * @param PromotionCollectionFactory $promotionCollectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        private readonly PromotionResource $resource,
        private readonly PromotionFactory $promotionFactory,
        private readonly PromotionCollectionFactory $promotionCollectionFactory,
        private readonly SearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
    ) {
    }

    /**
     * PromotionInterface save
     *
     * @param PromotionInterface $promotion
     * @return PromotionInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(PromotionInterface $promotion): PromotionInterface
    {
        $this->resource->save($promotion);
        return $promotion;
    }

    /**
     * PromotionInterface get by ID
     *
     * @param int $promotionId
     * @return PromotionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $promotionId): PromotionInterface
    {
        $promotion = $this->promotionFactory->create();
        $this->resource->load($promotion, $promotionId);
        if (!$promotion->getPromotionId()) {
            throw NoSuchEntityException::singleField(PromotionInterface::FIELD_PROMOTION_ID, $promotionId);
        }
        return $promotion;
    }

    /**
     * PromotionInterface delete
     *
     * @param PromotionInterface $promotion
     * @return void
     * @throws \Exception
     */
    public function delete(PromotionInterface $promotion): void
    {
        try {
            $this->resource->delete($promotion);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Failed to delete promotion.'), $e);
        }
    }

    /**
     * PromotionInterface delete by ID
     *
     * @param int $promotionId
     * @return void
     * @throws \Exception
     */
    public function deleteById(int $promotionId): void
    {
        $promotion = $this->getById($promotionId);
        $this->delete($promotion);
    }

    /**
     * PromotionInterface get list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PromotionInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array
    {
        $collection = $this->promotionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return (array)$searchResults->getItems();
    }
}
