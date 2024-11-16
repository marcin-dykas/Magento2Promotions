<?php

/**
 * @copyright Copyright (c) Marcin Dykas
 */

declare(strict_types=1);

namespace MarcinDykas\Promotions\Model\ResourceModel\Group;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MarcinDykas\Promotions\Model\Group as GroupModel;
use MarcinDykas\Promotions\Model\ResourceModel\Group as GroupResource;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(GroupModel::class, GroupResource::class);
    }
}
