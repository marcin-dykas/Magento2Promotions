<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

namespace MarcinDykas\Promotions\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use MarcinDykas\Promotions\Model\PromotionRepository;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion as PromotionResource;
use MarcinDykas\Promotions\Model\PromotionFactory;
use MarcinDykas\Promotions\Model\Promotion;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion\CollectionFactory as PromotionCollectionFactory;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class PromotionRepositoryTest extends TestCase
{
    /**
     * @var PromotionRepository
     */
    private PromotionRepository $repository;
    /**
     * @var PromotionResource
     */
    private $resourceMock;
    /**
     * @var PromotionFactory
     */
    private $promotionFactoryMock;
    /**
     * @var PromotionCollectionFactory
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
        $this->resourceMock = $this->createMock(PromotionResource::class);
        $this->promotionFactoryMock = $this->createMock(PromotionFactory::class);
        $this->collectionFactoryMock = $this->createMock(PromotionCollectionFactory::class);
        $this->searchResultsFactoryMock = $this->createMock(SearchResultsInterfaceFactory::class);
        $this->collectionProcessorMock = $this->createMock(CollectionProcessorInterface::class);

        $this->repository = new PromotionRepository(
            $this->resourceMock,
            $this->promotionFactoryMock,
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
        $promotionMock = $this->createMock(Promotion::class);

        $this->resourceMock->expects($this->once())
            ->method('save')
            ->with($promotionMock);

        $this->assertSame($promotionMock, $this->repository->save($promotionMock));
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetById(): void
    {
        $promotionId = 1;
        $promotionMock = $this->createMock(Promotion::class);

        $this->promotionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($promotionMock);

        $this->resourceMock->expects($this->once())
            ->method('load')
            ->with($promotionMock, $promotionId);

        $promotionMock->expects($this->once())
            ->method('getPromotionId')
            ->willReturn($promotionId);

        $this->assertSame($promotionMock, $this->repository->getById($promotionId));
    }

    /**
     * @return void
     * @throws NoSuchEntityException
     */
    public function testGetByIdThrowsNoSuchEntityException(): void
    {
        $promotionId = 999;
        $promotionMock = $this->createMock(Promotion::class);

        $this->promotionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($promotionMock);

        $this->resourceMock->expects($this->once())
            ->method('load')
            ->with($promotionMock, $promotionId);

        $promotionMock->expects($this->once())
            ->method('getPromotionId')
            ->willReturn(null);

        $this->expectException(NoSuchEntityException::class);
        $this->repository->getById($promotionId);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testDelete(): void
    {
        $promotionMock = $this->createMock(Promotion::class);

        $this->resourceMock->expects($this->once())
            ->method('delete')
            ->with($promotionMock);

        $this->repository->delete($promotionMock);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testDeleteThrowsCouldNotDeleteException(): void
    {
        $promotionMock = $this->createMock(Promotion::class);

        $this->resourceMock->expects($this->once())
            ->method('delete')
            ->with($promotionMock)
            ->willThrowException(new \Exception());

        $this->expectException(CouldNotDeleteException::class);
        $this->repository->delete($promotionMock);
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
