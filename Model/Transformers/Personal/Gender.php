<?php

namespace ClawRock\ID3Global\Model\Transformers\Personal;

use ClawRock\ID3Global\Model\Values\Personal\Gender as GenderValue;
use Magento\Framework\DataObject;

class Gender
{
    const GENDER_FIELD = 'gender';

    const MALE = '1';
    const FEMALE = '2';
    const UNSPECIFIED = '3';

    public function transform(DataObject $request): GenderValue
    {
        $genderValues = [
            self::MALE => GenderValue::MALE,
            self::FEMALE => GenderValue::FEMALE,
            self::UNSPECIFIED => GenderValue::UNSPECIFIED,
        ];

        $gender = $genderValues[$request->getData(self::GENDER_FIELD)] ?? GenderValue::UNKNOWN;

        return new GenderValue($gender);
    }
}
