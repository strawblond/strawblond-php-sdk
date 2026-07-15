<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateInvoiceStatusRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $id,
        protected string $status,
        protected ?string $paidAt = null,
        protected ?float $conversionRate = null,
        protected bool $notifyCustomer = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/invoice/{$this->id}/status";
    }

    protected function defaultBody(): array
    {
        $body = ['status' => $this->status];

        if ($this->paidAt !== null) {
            $body['paid_at'] = $this->paidAt;
        }

        if ($this->conversionRate !== null) {
            $body['conversion_rate'] = $this->conversionRate;
        }

        if ($this->notifyCustomer) {
            $body['notify_customer'] = true;
        }

        return $body;
    }
}
