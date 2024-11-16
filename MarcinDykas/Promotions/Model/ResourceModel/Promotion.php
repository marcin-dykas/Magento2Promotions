<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MarcinDykas\Promotions\Api\Data\PromotionInterface;

class Promotion extends AbstractDb
{
    public const TABLE = 'mdykas_promotions_promotion';

    protected function _construct(): void
    {
        $this->_init(self::TABLE, PromotionInterface::FIELD_PROMOTION_ID);
    }
}
