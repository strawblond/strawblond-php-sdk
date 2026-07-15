<?php

namespace StrawBlond\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ReopenOfferBillingRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected string $id,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/offer/{$this->id}/reopen-billing";
    }
}
