<?php

namespace Kg\CustExtAttr\Model;

use Magento\Framework\Model\AbstractModel;
use Kg\CustExtAttr\Model\ResourceModel\CustomerDescription as CustomerDescriptionResourceModel;
use Kg\CustExtAttr\Api\Data\CustomerDescriptionInterface;

class CustomerDescription extends AbstractModel implements CustomerDescriptionInterface
{

    protected function _construct()
    {
        $this->_init(CustomerDescriptionResourceModel::class);
    }

    /**
     * @param string $description
     * @return CustomerDescriptionInterface
     */
    public function setDescription(string $description): CustomerDescriptionInterface
    {
        $this->setData(CustomerDescriptionInterface::KEY_DESCRIPTION, $description  );
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->getData(CustomerDescriptionInterface::KEY_DESCRIPTION);
    }

    /**
     * @param bool $canShow
     * @return CustomerDescriptionInterface
     */
    public function setCanShow(bool $canShow): CustomerDescriptionInterface
    {
        $this->setData(CustomerDescriptionInterface::KEY_CAN_SHOW, $canShow);
        return $this;
    }

    /**
     * @return bool
     */
    public function getCanShow(): bool
    {
        return $this->getData(CustomerDescriptionInterface::KEY_CAN_SHOW);
    }

    /**
     * @param string $customerEmail
     * @return CustomerDescriptionInterface
     */
    public function setCustomerEmail(string $customerEmail): CustomerDescriptionInterface
    {
        $this->setData(CustomerDescriptionInterface::KEY_CUSTOMER_EMAIL, $customerEmail);
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->getData(CustomerDescriptionInterface::KEY_CUSTOMER_EMAIL);
    }

}
