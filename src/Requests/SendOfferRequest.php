<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SendOfferRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $id,
        protected array $recipients,
        protected ?string $message = null,
        protected bool $ccToOwner = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/offer/{$this->id}/send";
    }

    protected function defaultBody(): array
    {
        return [
            'email' => join(';', $this->recipients),
            'message' => $this->message,
            'ccToOwner' => $this->ccToOwner,
        ];
    }
}
