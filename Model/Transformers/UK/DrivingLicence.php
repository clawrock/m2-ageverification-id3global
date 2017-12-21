<?php

namespace ClawRock\ID3Global\Model\Transformers\UK;

use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence as DrivingLicenceValue;
use ClawRock\ID3Global\Model\Values\IdentityDocuments\UK\DrivingLicence\Number;
use Magento\Framework\DataObject;

class DrivingLicence
{
    const NUMBER_FIELD = 'driving_licence_number';

    public function transform(DataObject $request): DrivingLicenceValue
    {
        return new DrivingLicenceValue(
            new Number($request->getData(self::NUMBER_FIELD))
        );
    }
}
