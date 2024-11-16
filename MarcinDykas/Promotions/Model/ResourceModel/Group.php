<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MarcinDykas\Promotions\Api\Data\GroupInterface;

class Group extends AbstractDb
{
    public const TABLE = 'mdykas_promotions_group';

    protected function _construct(): void
    {
        $this->_init(self::TABLE, GroupInterface::FIELD_GROUP_ID);
    }
}
