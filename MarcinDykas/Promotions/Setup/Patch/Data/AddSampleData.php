<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use MarcinDykas\Promotions\Api\Data\GroupInterfaceFactory;
use MarcinDykas\Promotions\Api\Data\PromotionInterfaceFactory;
use MarcinDykas\Promotions\Model\PromotionRepository;
use MarcinDykas\Promotions\Model\GroupRepository;

class AddSampleData implements DataPatchInterface
{
    public const DEPENDENCIES = [];
    public const ALIASES = [];

    /**
     * @param GroupRepository $groupRepository
     * @param PromotionRepository $promotionRepository
     * @param GroupInterfaceFactory $groupFactory
     * @param PromotionInterfaceFactory $promotionFactory
     */
    public function __construct(
        private readonly GroupRepository $groupRepository,
        private readonly PromotionRepository $promotionRepository,
        private readonly GroupInterfaceFactory $groupFactory,
        private readonly PromotionInterfaceFactory $promotionFactory,
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return self::DEPENDENCIES;
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return self::ALIASES;
    }

    /**
     * @inheritDoc
     */
    public function apply(): void
    {
        $this->addSampleData('Black Week', 'Gray Monday');
        $this->addSampleData('Black Month', 'Yellow Wednesday');
    }

    /**
     * @param string $groupName
     * @param string $promotionName
     * @return void
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    private function addSampleData(string $groupName, string $promotionName): void
    {
        $group = $this->groupFactory->create();
        $group->setName($groupName);
        $this->groupRepository->save($group);
        $groupId = $group->getGroupId();

        $promotion = $this->promotionFactory->create();
        $promotion->setName($promotionName);
        $promotion->setGroupId($groupId);
        $this->promotionRepository->save($promotion);
    }
}
