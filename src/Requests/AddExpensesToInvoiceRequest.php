<?php

namespace StrawBlond\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class AddExpensesToInvoiceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  array<int, string>  $expenseIds  Hashed expense ids.
     */
    public function __construct(
        protected string $id,
        protected array $expenseIds,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/invoice/{$this->id}/add-expenses";
    }

    protected function defaultBody(): array
    {
        return ['expenses' => $this->expenseIds];
    }
}
