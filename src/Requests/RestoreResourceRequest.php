<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class RestoreResourceRequest extends Request
{
    protected Method $method = Method::PATCH;

    public function __construct(
        protected string $resource,
        protected string $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->resource}/{$this->id}/restore";
    }
}
