<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SendInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $id,
        protected array $recipients,
        protected ?string $message = null,
        protected bool $increaseDunningLevel = false,
        protected bool $ccToOwner = false,
        protected bool $adjustDates = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/invoice/{$this->id}/send";
    }

    protected function defaultBody(): array
    {
        return [
            'recipients' => join(';', $this->recipients),
            'message' => $this->message,
            'increaseDunningLevel' => $this->increaseDunningLevel,
            'ccToOwner' => $this->ccToOwner,
            'adjustDates' => $this->adjustDates,
        ];
    }
}
