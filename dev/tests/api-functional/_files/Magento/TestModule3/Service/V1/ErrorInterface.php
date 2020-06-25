<?php
/**
 * Interface for a test service for error handling testing
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\TestModule3\Service\V1;

interface ErrorInterface
{
    /**
     * @return \Magento\TestModule3\Service\V1\Entity\Parameter
     */
    public function success();

    /**
     * @return int Voucher
     */
    public function resourceNotFoundException();

    /**
     * @return int Voucher
     */
    public function serviceException();

    /**
     * @return int Voucher
     */
    public function authorizationException();

    /**
     * @return int Voucher
     */
    public function webapiException();

    /**
     * @return int Voucher
     */
    public function otherException();

    /**
     * @return int Voucher
     */
    public function returnIncompatibleDataType();

    /**
     * @param \Magento\TestModule3\Service\V1\Entity\WrappedErrorParameter[] $wrappedErrorParameters
     * @return int Voucher
     */
    public function inputException($wrappedErrorParameters);
}
