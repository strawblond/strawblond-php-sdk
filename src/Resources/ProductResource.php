<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class ProductResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'product';
    }
}
