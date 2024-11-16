<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model;

use MarcinDykas\Promotions\Api\Data\GroupInterface;
use MarcinDykas\Promotions\Api\GroupRepositoryInterface;
use MarcinDykas\Promotions\Model\ResourceModel\Group as GroupResource;
use MarcinDykas\Promotions\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use MarcinDykas\Promotions\Model\GroupFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Repository for Promotion Group entity.
 */
class GroupRepository implements GroupRepositoryInterface
{
    public function __construct(
        private readonly GroupResource $resource,
        private readonly GroupFactory $groupFactory,
        private readonly GroupCollectionFactory $groupCollectionFactory,
        private readonly SearchResultsInterfaceFactory $searchResultsFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
    ) {}

    /**
     * @param GroupInterface $group
     * @return GroupInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(GroupInterface $group): GroupInterface
    {
        $this->resource->save($group);
        return $group;
    }

    /**
     * @param int $groupId
     * @return GroupInterface
     */
    public function getById(int $groupId): GroupInterface
    {
        $group = $this->groupFactory->create();
        $this->resource->load($group, $groupId);
        if (!$group->getGroupId()) {
            throw NoSuchEntityException::singleField(GroupInterface::FIELD_GROUP_ID, $groupId);
        }
        return $group;
    }

    /**
     * @param GroupInterface $group
     * @return void
     * @throws \Exception
     */
    public function delete(GroupInterface $group): void
    {
        try {
            $this->resource->delete($group);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Failed to delete group.'), $e);
        }
    }

    /**
     * @param int $groupId
     * @return void
     * @throws \Exception
     */
    public function deleteById(int $groupId): void
    {
        $group = $this->getById($groupId);
        $this->delete($group);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return GroupInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array
    {
        $collection = $this->groupCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return (array)$searchResults->getItems();
    }
}
