<?php

namespace ClawRock\ID3Global\Model\Transformers;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\InternationalPassport as InternationalPassportValue;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;
use Magento\Framework\DataObject;

class InternationalPassport
{
    const NUMBER_FIELD = 'passport_number';
    const EXPIRY_FIELD = 'expiry_date';

    public function transform(DataObject $request): InternationalPassportValue
    {
        return new InternationalPassportValue(
            new Number($request->getData(self::NUMBER_FIELD)),
            new Date(new \DateTime($request->getData(self::EXPIRY_FIELD)))
        );
    }
}
