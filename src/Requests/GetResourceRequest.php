<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetResourceRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $resource,
        protected string $id,
        protected array $include = [],
    ) {
        if (empty($this->id)) {
            throw new \InvalidArgumentException('ID cannot be empty');
        }
    }

    public function resolveEndpoint(): string
    {
        return "/{$this->resource}/{$this->id}";
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'include' => implode(',', $this->include),
        ]);
    }
}
