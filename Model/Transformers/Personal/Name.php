<?php

namespace ClawRock\ID3Global\Model\Transformers\Personal;

use ClawRock\ID3Global\Model\Values\Personal\Name as NameValue;
use Magento\Framework\DataObject;

class Name
{
    const FIRSTNAME_FIELD = 'firstname';
    const LASTNAME_FIELD = 'lastname';
    const TITLE_FIELD = 'title';

    public function transform(DataObject $request): NameValue
    {
        return new NameValue(
            $request->getData(self::FIRSTNAME_FIELD),
            $request->getData(self::LASTNAME_FIELD),
            $request->getData(self::TITLE_FIELD)
        );
    }
}
