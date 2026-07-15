<?php

namespace StrawBlond\Resources;

use Saloon\Http\Connector;
use Saloon\Http\Response;
use StrawBlond\Resources\CrudResource;

/**
 * Scoped resource for the payments nested under an invoice.
 *
 * Mirrors DocumentElementResource: the scope (invoice id) is baked into the
 * resource slug, so the generic *ResourceRequest classes resolve the correct
 * nested endpoints (e.g. GET/POST /invoice/{invoiceId}/payment,
 * GET/DELETE /invoice/{invoiceId}/payment/{id}).
 *
 * There is no update route for payments, so update() is disabled.
 */
class InvoicePaymentResource extends CrudResource
{
    public function __construct(
        readonly protected Connector $connector,
        readonly protected string $invoiceId,
    ) {}

    protected function getResource(): string
    {
        return "invoice/{$this->invoiceId}/payment";
    }

    public function update(string $id, array $changes): Response
    {
        throw new \BadMethodCallException('Invoice payments cannot be updated.');
    }
}
