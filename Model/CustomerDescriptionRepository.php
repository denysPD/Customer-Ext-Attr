<?php

declare(strict_types=1);

namespace Kg\CustExtAttr\Model;

use Kg\CustExtAttr\Model\ResourceModel\CustomerDescription;
use Kg\CustExtAttr\Model\CustomerDescriptionFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Kg\CustExtAttr\Api\Data\CustomerDescriptionInterface;
use Kg\CustExtAttr\Api\CustomerDescriptionRepositoryInterface;

class CustomerDescriptionRepository implements CustomerDescriptionRepositoryInterface
{
    public function __construct(
        private readonly CustomerDescription $customerDescriptionResourceModel,
        private readonly  CustomerDescriptionFactory $customerDescriptionFactory
    ) {
    }


    public function getById(int $id)
    {
        $customerDescription = $this->customerDescriptionFactory->create();
        $this->customerDescriptionResourceModel->load($customerDescription, $id);
        if (!$customerDescription->getId()) {
            throw new NoSuchEntityException(__('Unable to find Customer Description with ID "%1"', $id));
        }
        return $customerDescription;
    }


    public function getByCustomerEmail(string $customerEmail)
    {
        $customerDescription = $this->customerDescriptionFactory->create();
        $this->customerDescriptionResourceModel->loadByCustomerEmail($customerDescription, $customerEmail);
        if (!$customerDescription->getId()) {
            throw new NoSuchEntityException(__('Unable to find Customer Description with email "%1"', $customerEmail));
        }
        return $customerDescription;
    }


    public function save(CustomerDescriptionInterface $customerDescription)
    {
        try {
            $this->customerDescriptionResourceModel->save($customerDescription);
        } catch (AlreadyExistsException $e) {
            throw new AlreadyExistsException(
                __('Could not save customer description: %1', $e->getMessage())
            );
        }

        return $customerDescription;
    }


    public function delete(CustomerDescriptionInterface $customerDescription)
    {
        try {
            $this->customerDescriptionResourceModel->delete($customerDescription);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

}
