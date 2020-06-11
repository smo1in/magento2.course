<?php

namespace Vendor\Voucher\Model;

use Exception;
use Magento\Customer\Model\CustomerFactory as CustomerModelFactory;
use Magento\Framework\Exception\LocalizedException;
use Vendor\Voucher\Api\VoucherManagementInterface;
use Vendor\Voucher\Model\ResourceModel\Voucher as VoucherResource;
use Vendor\Voucher\Model\ResourceModel\Voucher\CollectionFactory as VoucherCollectionFactory;
use Vendor\Voucher\Model\ResourceModel\VoucherStatus as VoucherStatusResourceModel;
use Vendor\Voucher\Model\ResourceModel\VoucherStatus\CollectionFactory as VoucherStatusCollectionFactory;
use Vendor\Voucher\Model\VoucherFactory as VoucherModelFactory;
use Vendor\Voucher\Model\VoucherStatusFactory as VoucherStatusModelFactory;

class VoucherManagement implements VoucherManagementInterface
{
    /**@var VoucherStatusModelFactory */
    private $voucherStatusModelFactory;
    /**@var VoucherStatusCollectionFactory */
    private $voucherStatusCollectionFactory;
    /**@var VoucherStatusResourceModel */
    private $voucherStatusResourceFactory;
    /**@var VoucherFactory */
    private $voucherModelFactory;
    /**@var VoucherResource */
    private $voucherResourceFactory;
    /**@var VoucherCollectionFactory */
    private $voucherCollectionFactory;
    /**@var CustomerModelFactory */
    private $customerModelFactory;
    private $voucherStatusResourceModel;

    /**
     * VoucherManagement constructor.
     * @param VoucherStatusCollectionFactory $voucherStatusCollectionFactory
     * @param VoucherStatusFactory $voucherStatusModelFactory
     * @param VoucherStatusResourceModel $voucherStatusResourceFactory
     * @param VoucherFactory $voucherModelFactory
     * @param VoucherResource $voucherResourceFactory
     * @param VoucherCollectionFactory $voucherCollectionFactory
     * @param CustomerModelFactory $customerModelFactory
     */
    public function __construct(
        VoucherStatusCollectionFactory $voucherStatusCollectionFactory,
        VoucherStatusModelFactory $voucherStatusModelFactory,
        VoucherStatusResourceModel $voucherStatusResourceFactory,
        VoucherModelFactory $voucherModelFactory,
        VoucherResource $voucherResourceFactory,
        VoucherCollectionFactory $voucherCollectionFactory,
        CustomerModelFactory $customerModelFactory
    )
    {
        $this->voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
        $this->voucherStatusModelFactory = $voucherStatusModelFactory;
        $this->voucherStatusResourceFactory = $voucherStatusResourceFactory;
        $this->voucherModelFactory = $voucherModelFactory;
        $this->voucherResourceFactory = $voucherResourceFactory;
        $this->voucherCollectionFactory = $voucherCollectionFactory;
        $this->customerModelFactory = $customerModelFactory;
    }

    public function createVoucherStatus($status)
    {
        $voucherStatus = $this->voucherStatusModelFactory->create();
        $voucherStatus->setStatusCode($status);
        try {
            $this->voucherStatusResourceFactory->save($voucherStatus);
            $response = ['idVoucherStatusCode' => ($voucherStatus->getId())];
            return json_encode($response);
        } catch (Exception $e) {
            throw new Exception("Status has code already");

        }
    }

    public function deleteVoucherStatus($id)
    {
        $voucherStatus = $this->voucherStatusModelFactory->create();
        $this->voucherStatusResourceFactory->load($voucherStatus, $id);
        if (!$voucherStatus->getId()) {
            throw new Exception("There is no statusCode with id $id");
        }
        $voucherStatus->setId($id)->delete();
        return $response = ("StatusCode $id has been delete");
    }

    public function getAllVoucherStatuses()
    {
        $data = [];
        $voucherStatusCollection = $this->voucherStatusCollectionFactory->create();
        /** @var VoucherStatus $voucherStatus */
        foreach ($voucherStatusCollection as $voucherStatus) {
            $data[] = $voucherStatus->getStatusCode();
        }
        return $data;

    }

    public function createVoucher($customer_id, $status_id, $voucher_code)
    {
        $voucher = $this->voucherModelFactory->create();
        $voucher->setCustomerId($customer_id);
        $voucher->setStatusId($status_id);
        $voucher->setVoucherCode($voucher_code);
        try {
            $this->voucherResourceFactory->save($voucher);
            $response = ['idVoucher' => $voucher->getId()];
            return json_encode($response);
        } catch (Exception $e) {
            throw new Exception("Error");
        }

    }

    public function deleteVoucher($id)
    {
        $voucher = $this->voucherModelFactory->create();
        $this->voucherResourceFactory->load($voucher, $id);
        if (!$voucher->getId()) {
            return $response = "There is no Voucher with id $id";
        }
        $voucher->setId($id)->delete();
        return $response = ("voucher $id has been delete");


    }

    public function getAllVouchers()
    {
        $data = [];
        $voucherCollection = $this->voucherCollectionFactory->create();
        foreach ($voucherCollection as $voucher) {
            $data[] = $voucher->getData();
        }
        return $data;
    }

    public function getAllVouchersByCustomerId($id)
    {
        $data = [];
        $customer = $this->customerModelFactory->create()->load($id);

        $voucherCollection = $this->voucherCollectionFactory->create();

        if (!$customer || !$customer->getId()) {
            throw new Exception("Customer $id is invalid, $id");
        }

        /** @var Voucher $vouchers */
        foreach ($voucherCollection->filterByCustomerId($customer->getId()) as $vouchers) {
            $data[] = $vouchers->getData();
        }

        return $data;
    }
}
