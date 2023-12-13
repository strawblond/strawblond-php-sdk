<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class CompanyResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'company';
    }
}
