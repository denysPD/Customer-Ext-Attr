<?php

declare(strict_types=1);

namespace Kg\CustExtAttr\Model\ResourceModel\CustomerDescription;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kg\CustExtAttr\Model\ResourceModel\CustomerDescription as CustomerDescriptionResourceModel;
use Kg\CustExtAttr\Model\CustomerDescription as CustomerDescriptionDomainModel;

class Collection extends AbstractCollection
{
    /**
     * Initialize collection model
     */
    protected function _construct()
    {
        $this->_init(CustomerDescriptionDomainModel::class, CustomerDescriptionResourceModel::class);
    }
}
