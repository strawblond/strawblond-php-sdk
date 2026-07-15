<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class NextInvoiceInfoRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $issuedAt = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/invoice/next-info';
    }

    protected function defaultQuery(): array
    {
        return $this->issuedAt === null ? [] : ['issued_at' => $this->issuedAt];
    }
}
