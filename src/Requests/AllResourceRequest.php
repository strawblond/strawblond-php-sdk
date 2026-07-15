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
        protected ?int $perPage = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/' . $this->resource;
    }

    protected function defaultQuery(): array
    {
        $query = [];

        foreach ($this->filters as $key => $value) {
            // Keep any meaningful filter value, including falsy ones like 0 or false.
            // Skip null and '' (empty string), which callers use to mean "unset" — sending
            // them would trigger real backend filtering (matching nothing).
            // Booleans are encoded as 0/1 so Laravel's boolean validation reads them correctly.
            if ($value === null || $value === '') {
                continue;
            }

            $query['filter[' . $key . ']'] = is_bool($value) ? (int) $value : $value;
        }

        if ($this->include !== []) {
            $query['include'] = implode(',', $this->include);
        }

        if ($this->sort !== null) {
            $query['sort'] = $this->sort;
        }

        $query['page'] = $this->page;

        if ($this->perPage !== null) {
            $query['per_page'] = $this->perPage;
        }

        return $query;
    }
}
