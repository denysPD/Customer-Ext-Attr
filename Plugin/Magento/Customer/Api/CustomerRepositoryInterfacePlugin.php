<?php

namespace Kg\CustExtAttr\Plugin\Magento\Customer\Api;

use Magento\Customer\Api\CustomerRepositoryInterface as Subject;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerSearchResultsInterface;
use Magento\Customer\Api\Data\CustomerExtension;
use Magento\Customer\Api\Data\CustomerExtensionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Kg\CustExtAttr\Api\CustomerDescriptionRepositoryInterface;
use Kg\CustExtAttr\Api\Data\CustomerDescriptionInterface;
use Kg\CustExtAttr\Api\Data\CustomerDescriptionInterfaceFactory;

class CustomerRepositoryInterfacePlugin
{

    public function __construct(
        private readonly CustomerExtensionFactory $customerExtensionFactory,
        private readonly CustomerDescriptionRepositoryInterface $customerDescriptionExtensionAttributeRepository,
        private readonly CustomerDescriptionInterfaceFactory $customerDescriptionFactory
    ) {
    }

    public function afterGetById(Subject $subject, CustomerInterface $customer): CustomerInterface
    {
        return $this->addCustomerDescriptionExtAttr($customer);
    }

    public function afterGet(Subject $subject, CustomerInterface $customer): CustomerInterface
    {
        return $this->addCustomerDescriptionExtAttr($customer);
    }

    public function afterGetList(Subject $subject, CustomerSearchResultsInterface $customerSearchResults): CustomerSearchResultsInterface
    {
        foreach ($customerSearchResults->getItems() as $customer) {
            $this->addCustomerDescriptionExtAttr($customer);
        }
        return $customerSearchResults;
    }

    public function afterSave(Subject $subject, CustomerInterface $customer)
    {
        $this->saveCustomerDescription($customer);
        return $customer;
    }

    private function saveCustomerDescription(CustomerInterface $customer)
    {
        $extensionAttributes = $customer->getExtensionAttributes();
        if ($extensionAttributes) {
            $customerEmail = $customer->getEmail();
            $customerDescriptionData = $extensionAttributes->getCustomerDescription();
            try {
                $customerDescriptionModel = $this->customerDescriptionExtensionAttributeRepository->getByCustomerEmail($customerEmail);
            } catch (NoSuchEntityException $e) {
                $customerDescriptionModel = $this->customerDescriptionFactory->create();
                $customerDescriptionModel->setCustomerEmail($customerEmail);

            }
            try {
                $customerDescriptionModel->setCanShow($customerDescriptionData->getCanShow())
                    ->setDescription($customerDescriptionData->getDescription());
                $this->customerDescriptionExtensionAttributeRepository->save($customerDescriptionModel);
            }catch (\Exception $e) {
                throw new CouldNotSaveException(
                    __('Could not add attribute to customer: "%1"', $e->getMessage()),
                    $e
                );
            }
        }
    }

    /**
     * @param CustomerInterface $customer
     * @return CustomerInterface
     */
    private function addCustomerDescriptionExtAttr(CustomerInterface $customer): CustomerInterface
    {
        try {
            $customerDescription = $this->customerDescriptionExtensionAttributeRepository->getByCustomerEmail($customer->getEmail());
        } catch (NoSuchEntityException $e) {
            return $customer;
        }
        $extensionAttributes = $customer->getExtensionAttributes();
        $customerExtension = $extensionAttributes ?: $this->customerExtensionFactory->create();

        $customerExtension->setCustomerDescription($customerDescription);

        $customer->setExtensionAttributes($customerExtension);
        return $customer;
    }
}
