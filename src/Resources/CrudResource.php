<?php

namespace StrawBlond\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use StrawBlond\Requests\AllResourceRequest;
use StrawBlond\Requests\CreateResourceRequest;
use StrawBlond\Requests\DeleteResourceRequest;
use StrawBlond\Requests\GetResourceRequest;
use StrawBlond\Requests\UpdateResourceRequest;

abstract class CrudResource extends BaseResource
{
    /**
     * Get the resource name.
     */
    abstract protected function getResource(): string;

    public function create(array $data): Response
    {
        return $this->connector->send(new CreateResourceRequest($this->getResource(), $data));
    }

    public function get(string $id, array $include = []): Response
    {
        return $this->connector->send(new GetResourceRequest($this->getResource(), $id, $include));
    }

    public function all(array $filters = [], array $include = [], string $sort = null, int $page = 1): Response
    {
        return $this->connector->send(new AllResourceRequest($this->getResource(), $filters, $include, $sort, $page));
    }

    public function update(string $id, array $changes): Response
    {
        return $this->connector->send(new UpdateResourceRequest($this->getResource(), $id, $changes));
    }

    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteResourceRequest($this->getResource(), $id));
    }
}
