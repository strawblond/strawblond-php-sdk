<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\SendInvoiceRequest;
use StrawBlond\Requests\UpdateInvoiceStatusRequest;
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
    public function drafts(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'draft'], $include, $sort, $page);
    }

    /**
     * Get all pending invoices
     */
    public function pending(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'pending'], $include, $sort, $page);
    }

    /**
     * Get all paid invoices
     */
    public function paid(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'paid'], $include, $sort, $page);
    }

    /**
     * Get all open invoices
     */
    public function open(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'open'], $include, $sort, $page);
    }

    /**
     * Get all overdue invoices
     */
    public function overdue(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'overdue'], $include, $sort, $page);
    }

    /**
     * Get all dunned invoices
     */
    public function dunned(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'dunned'], $include, $sort, $page);
    }

    /**
     * Get all scheduled invoices
     */
    public function scheduled(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'scheduled'], $include, $sort, $page);
    }

    /**
     * Get all invoices ready for delivery
     */
    public function readyForDelivery(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return $this->all([...$filters, 'status' => 'rfd'], $include, $sort, $page);
    }

    /**
     * Get the document element resource for an invoice
     */
    public function lineItems(string $invoiceId): DocumentElementResource
    {
        return new DocumentElementResource($this->connector, 'invoice', $invoiceId);
    }

    /**
     * Get the payments sub-resource for an invoice
     */
    public function payments(string $invoiceId): InvoicePaymentResource
    {
        return new InvoicePaymentResource($this->connector, $invoiceId);
    }

    /**
     * Send an invoice
     */
    public function send(string $id, array $recipients, ?string $message = null, bool $increaseDunningLevel = false, bool $ccToOwner = false, bool $adjustDates = false, array $attachments = []): Response
    {
        return $this->connector->send(new SendInvoiceRequest($id, $recipients, $message, $increaseDunningLevel, $ccToOwner, $adjustDates, $attachments));
    }

    /**
     * Update the status of an invoice
     */
    public function updateStatus(string $id, string $status, ?string $paidAt = null, ?float $conversionRate = null, bool $notifyCustomer = false): Response
    {
        return $this->connector->send(new UpdateInvoiceStatusRequest($id, $status, $paidAt, $conversionRate, $notifyCustomer));
    }

    /**
     * Mark an invoice as paid
     */
    public function markAsPaid(string $id, ?string $paidAt = null, ?float $conversionRate = null, bool $notifyCustomer = false): Response
    {
        return $this->updateStatus($id, 'paid', $paidAt, $conversionRate, $notifyCustomer);
    }

    /**
     * Mark an invoice as pending
     */
    public function markAsPending(string $id): Response
    {
        return $this->updateStatus($id, 'pending');
    }

    /**
     * Mark an invoice as draft
     */
    public function markAsDraft(string $id): Response
    {
        return $this->updateStatus($id, 'draft');
    }
}
