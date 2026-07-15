<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\RestoreResourceRequest;
use StrawBlond\Resources\CrudResource;

class ExpenseResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'expense';
    }

    public function restore(string $id): Response
    {
        return $this->connector->send(new RestoreResourceRequest($this->getResource(), $id));
    }
}
