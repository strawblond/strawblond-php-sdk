<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class ExpenseResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'expense';
    }
}
