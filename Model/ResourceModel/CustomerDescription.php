<?php

declare(strict_types=1);

namespace Kg\CustExtAttr\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerDescription extends AbstractDb
{
    /** @const string */
    private const KG_CUSTOMER_DESCRIPTION = 'kg_customer_description';

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init(self::KG_CUSTOMER_DESCRIPTION, 'id');
    }

    /**
     * Load NS Extension Attributes by Order id
     *
     * @param AbstractModel $object
     * @param int $entityId
     * @return $this
     * @codeCoverageIgnore
     */
    public function loadByCustomerEmail($object, $email)
    {
        return $this->load($object, $email, 'customer_email');
    }
}
