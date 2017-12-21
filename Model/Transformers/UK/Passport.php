<?php

namespace ClawRock\ID3Global\Model\Transformers\UK;

use ClawRock\AgeVerification\Model\Values\Date;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\Passport as PassportValue;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\Passport\Number;
use Magento\Framework\DataObject;

class Passport
{
    const NUMBER_FIELD = 'passport_number';
    const EXPIRY_FIELD = 'expiry_date';

    public function transform(DataObject $request): PassportValue
    {
        return new PassportValue(
            new Number($request->getData(self::NUMBER_FIELD)),
            new Date(new \DateTime($request->getData(self::EXPIRY_FIELD)))
        );
    }
}
