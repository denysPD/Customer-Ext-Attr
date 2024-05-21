<?php

declare(strict_types=1);

namespace Kg\CustExtAttr\Api;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Kg\CustExtAttr\Api\Data\CustomerDescriptionInterface;

interface CustomerDescriptionRepositoryInterface
{
    /**
     * @param int $id
     * @return CustomerDescriptionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id);

    /**
     * @param string $customerEmail
     * @return CustomerDescriptionInterface
     * @throws NoSuchEntityException
     */
    public function getByCustomerEmail(string $customerEmail);

    /**
     * @param CustomerDescriptionInterface $customerDescription
     * @return CustomerDescriptionInterface
     * @throws AlreadyExistsException
     */
    public function save(CustomerDescriptionInterface $customerDescription);

    /**
     * @param CustomerDescriptionInterface $customerDescription
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(CustomerDescriptionInterface $customerDescription);
}
