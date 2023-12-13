<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\SendInvoiceRequest;
use StrawBlond\Resources\CrudResource;

class InvoiceResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'invoice';
    }

    /**
     * Get all draft invoices
     */
    public function drafts(array $filters = [], array $include = [], string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'draft'], $include, $sort, $page);
    }

    /**
     * Get all pending invoices
     */
    public function pending(array $filters = [], array $include = [], string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'pending'], $include, $sort, $page);
    }

    /**
     * Get all paid invoices
     */
    public function paid(array $filters = [], array $include = [], string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'paid'], $include, $sort, $page);
    }

    /**
     * Get the document element resource for an invoice
     */
    public function lineItems(string $invoiceId): DocumentElementResource
    {
        return new DocumentElementResource($this->connector, 'invoice', $invoiceId);
    }

    /**
     * Send an invoice
     */
    public function send(string $id, array $recipients, ?string $message = null, bool $increaseDunningLevel = false, bool $ccToOwner = false, bool $adjustDates = false): Response
    {
        return $this->connector->send(new SendInvoiceRequest(...func_get_args()));
    }
}
