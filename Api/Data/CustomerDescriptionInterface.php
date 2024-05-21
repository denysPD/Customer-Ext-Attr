<?php

namespace Kg\CustExtAttr\Api\Data;

interface CustomerDescriptionInterface
{

    const KEY_CUSTOMER_EMAIL = 'customer_email';
    const KEY_DESCRIPTION = 'description';
    const KEY_CAN_SHOW = 'can_show';

    /**
     * @param string $description
     * @return CustomerDescriptionInterface
     */
    public function setDescription(string $description): CustomerDescriptionInterface;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param bool $canShow
     * @return CustomerDescriptionInterface
     */
    public function setCanShow(bool $canShow): CustomerDescriptionInterface;

    /**
     * @return bool
     */
    public function getCanShow(): bool;

    /**
     * @param string $customerEmail
     * @return CustomerDescriptionInterface
     */
    public function setCustomerEmail(string $customerEmail): CustomerDescriptionInterface;

    /**
     * @return string
     */
    public function getCustomerEmail(): string;

}
