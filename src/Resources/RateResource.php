<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class RateResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'rate';
    }
}
