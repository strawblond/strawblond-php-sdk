<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class TimeResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'time';
    }
}
