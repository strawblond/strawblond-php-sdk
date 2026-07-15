<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\CloneResourceRequest;
use StrawBlond\Resources\CrudResource;

class ContactResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'contact';
    }

    public function clone(string $id, array $overrides = []): Response
    {
        return $this->connector->send(new CloneResourceRequest($this->getResource(), $id, $overrides));
    }
}
