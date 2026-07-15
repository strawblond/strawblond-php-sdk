<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CloneResourceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $resource,
        protected string $id,
        protected array $overrides = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->resource}/{$this->id}/clone";
    }

    protected function defaultBody(): array
    {
        return $this->overrides;
    }
}
