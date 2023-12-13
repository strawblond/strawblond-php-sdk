<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateResourceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected string $resource,
        protected string $id,
        protected array $changes = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->resource}/{$this->id}";
    }

    protected function defaultBody(): array
    {
        return $this->changes;
    }
}
