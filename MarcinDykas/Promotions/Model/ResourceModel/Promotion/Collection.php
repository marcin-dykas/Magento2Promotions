<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model\ResourceModel\Promotion;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MarcinDykas\Promotions\Model\Promotion as PromotionModel;
use MarcinDykas\Promotions\Model\ResourceModel\Promotion as PromotionResource;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(PromotionModel::class, PromotionResource::class);
    }
}
