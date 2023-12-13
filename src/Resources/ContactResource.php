<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class ContactResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'contact';
    }
}
