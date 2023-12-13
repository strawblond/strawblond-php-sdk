<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteResourceRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $resource,
        protected string $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->resource}/{$this->id}";
    }
}
