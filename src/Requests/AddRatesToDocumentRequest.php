<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddRatesToDocumentRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $document  The document slug ('invoice' or 'offer').
     * @param  array<int, array{id: string, quantity: float}>  $rates  Each entry is
     *         ['id' => hashedRateId, 'quantity' => float]; passed through as given.
     */
    public function __construct(
        protected string $document,
        protected string $id,
        protected array $rates,
        protected ?int $beforeOrder = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/{$this->document}/{$this->id}/add-rates";
    }

    protected function defaultBody(): array
    {
        $body = ['rates' => $this->rates];

        if ($this->beforeOrder !== null) {
            $body['beforeOrder'] = $this->beforeOrder;
        }

        return $body;
    }
}
