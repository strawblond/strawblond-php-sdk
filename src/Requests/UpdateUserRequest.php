<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateUserRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function __construct(
        protected array $changes = [],
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/user";
    }

    protected function defaultBody(): array
    {
        return $this->changes;
    }
}
