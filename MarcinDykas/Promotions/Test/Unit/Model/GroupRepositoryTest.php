<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

namespace MarcinDykas\Promotions\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use MarcinDykas\Promotions\Model\GroupRepository;
use MarcinDykas\Promotions\Model\ResourceModel\Group as GroupResource;
use MarcinDykas\Promotions\Model\GroupFactory;
use MarcinDykas\Promotions\Model\Group;
use MarcinDykas\Promotions\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use MarcinDykas\Promotions\Model\ResourceModel\Group\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class GroupRepositoryTest extends TestCase
{
    /**
     * @var GroupRepository
     */
    private GroupRepository $repository;
    /**
     * @var GroupResource
     */
    private $resourceMock;
    /**
     * @var GroupFactory
     */
    private $groupFactoryMock;
    /**
     * @var GroupCollectionFactory
     */
    private $collectionFactoryMock;
    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultsFactoryMock;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessorMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->resourceMock = $this->createMock(GroupResource::class);
        $this->groupFactoryMock = $this->createMock(GroupFactory::class);
        $this->collectionFactoryMock = $this->createMock(GroupCollectionFactory::class);
        $this->searchResultsFactoryMock = $this->createMock(SearchResultsInterfaceFactory::class);
        $this->collectionProcessorMock = $this->createMock(CollectionProcessorInterface::class);

        $this->repository = new GroupRepository(
            $this->resourceMock,
            $this->groupFactoryMock,
            $this->collectionFactoryMock,
            $this->searchResultsFactoryMock,
            $this->collectionProcessorMock
        );
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function testSave(): void
    {
        $groupMock = $this->createMock(Group::class);

        $this->resourceMock->expects($this->once())
            ->method('save')
            ->with($groupMock);

        $this->assertSame($groupMock, $this->repository->save($groupMock));
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetById(): void
    {
        $groupId = 1;
        $groupMock = $this->createMock(Group::class);

        $this->groupFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($groupMock);

        $this->resourceMock->expects($this->once())
            ->method('load')
            ->with($groupMock, $groupId);

        $groupMock->expects($this->once())
            ->method('getGroupId')
            ->willReturn($groupId);

        $this->assertSame($groupMock, $this->repository->getById($groupId));
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIdThrowsNoSuchEntityException(): void
    {
        $groupId = 999;
        $groupMock = $this->createMock(Group::class);

        $this->groupFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($groupMock);

        $this->resourceMock->expects($this->once())
            ->method('load')
            ->with($groupMock, $groupId);

        $groupMock->expects($this->once())
            ->method('getGroupId')
            ->willReturn(null);

        $this->expectException(NoSuchEntityException::class);
        $this->repository->getById($groupId);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testDelete(): void
    {
        $groupMock = $this->createMock(Group::class);

        $this->resourceMock->expects($this->once())
            ->method('delete')
            ->with($groupMock);

        $this->repository->delete($groupMock);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testDeleteThrowsCouldNotDeleteException(): void
    {
        $groupMock = $this->createMock(Group::class);

        $this->resourceMock->expects($this->once())
            ->method('delete')
            ->with($groupMock)
            ->willThrowException(new \Exception());

        $this->expectException(CouldNotDeleteException::class);
        $this->repository->delete($groupMock);
    }

    /**
     * @return void
     */
    public function testGetList(): void
    {
        $searchCriteriaMock = $this->createMock(SearchCriteriaInterface::class);
        $collectionMock = $this->createMock(Collection::class);
        $searchResultsMock = $this->createMock(SearchResultsInterface::class);

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($collectionMock);

        $this->collectionProcessorMock->expects($this->once())
            ->method('process')
            ->with($searchCriteriaMock, $collectionMock);

        $collectionMock->expects($this->once())
            ->method('getItems')
            ->willReturn([]);

        $collectionMock->expects($this->once())
            ->method('getSize')
            ->willReturn(0);

        $this->searchResultsFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($searchResultsMock);

        $searchResultsMock->expects($this->once())
            ->method('setSearchCriteria')
            ->with($searchCriteriaMock);

        $searchResultsMock->expects($this->once())
            ->method('setItems')
            ->with([]);

        $searchResultsMock->expects($this->once())
            ->method('setTotalCount')
            ->with(0);

        $this->assertSame([], $this->repository->getList($searchCriteriaMock));
    }
}
