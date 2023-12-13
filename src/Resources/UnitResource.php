<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class UnitResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'unit';
    }
}
