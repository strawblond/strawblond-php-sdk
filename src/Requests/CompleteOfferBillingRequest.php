<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CompleteOfferBillingRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $id,
        protected ?string $reason = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/offer/{$this->id}/complete-billing";
    }

    protected function defaultBody(): array
    {
        return $this->reason === null ? [] : ['reason' => $this->reason];
    }
}
