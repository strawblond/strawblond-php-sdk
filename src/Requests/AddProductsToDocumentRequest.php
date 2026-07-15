<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddProductsToDocumentRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $document  The document slug ('invoice' or 'offer').
     * @param  array<int, string>  $productIds  Hashed product ids.
     */
    public function __construct(
        protected string $document,
        protected string $id,
        protected array $productIds,
        protected ?int $beforeOrder = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/{$this->document}/{$this->id}/add-products";
    }

    protected function defaultBody(): array
    {
        $body = ['products' => $this->productIds];

        if ($this->beforeOrder !== null) {
            $body['beforeOrder'] = $this->beforeOrder;
        }

        return $body;
    }
}
