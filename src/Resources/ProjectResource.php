<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\RestoreResourceRequest;
use StrawBlond\Resources\CrudResource;

class ProjectResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'project';
    }

    public function restore(string $id): Response
    {
        return $this->connector->send(new RestoreResourceRequest($this->getResource(), $id));
    }
}
