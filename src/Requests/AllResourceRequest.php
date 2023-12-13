<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class AllResourceRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $resource,
        protected array $filters = [],
        protected array $include = [],
        protected ?string $sort = null,
        protected int $page = 1,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/' . $this->resource;
    }

    protected function defaultQuery(): array
    {
        return array_filter(
            [
                ...array_combine(
                    array_map(
                        fn ($filter) => 'filter[' . $filter . ']',
                        array_keys($this->filters)
                    ),
                    array_values($this->filters)
                ),
                'include' => implode(',', $this->include),
                'sort' => $this->sort,
                'page' => $this->page,
            ]
        );
    }
}
