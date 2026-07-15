<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\AddExpensesToInvoiceRequest;
use StrawBlond\Requests\AddProductsToDocumentRequest;
use StrawBlond\Requests\AddRatesToDocumentRequest;
use StrawBlond\Requests\CloneResourceRequest;
use StrawBlond\Requests\CreateNextRecurringInvoiceRequest;
use StrawBlond\Requests\NextInvoiceInfoRequest;
use StrawBlond\Requests\RestoreResourceRequest;
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
    public function drafts(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'draft'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all pending invoices
     */
    public function pending(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'pending'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all paid invoices
     */
    public function paid(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'paid'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all open invoices
     */
    public function open(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'open'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all overdue invoices
     */
    public function overdue(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'overdue'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all dunned invoices
     */
    public function dunned(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'dunned'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all scheduled invoices
     */
    public function scheduled(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'scheduled'], $include, $sort, $page, $perPage);
    }

    /**
     * Get all invoices ready for delivery
     */
    public function readyForDelivery(array $filters = [], array $include = [], ?string $sort = null, int $page = 1, ?int $perPage = null): Response
    {
        return $this->all([...$filters, 'status' => 'rfd'], $include, $sort, $page, $perPage);
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

    /**
     * Clone an invoice
     */
    public function clone(string $id, array $overrides = []): Response
    {
        return $this->connector->send(new CloneResourceRequest('invoice', $id, $overrides));
    }

    /**
     * Restore a soft-deleted invoice
     */
    public function restore(string $id): Response
    {
        return $this->connector->send(new RestoreResourceRequest('invoice', $id));
    }

    /**
     * Create the next invoice in a recurring series
     */
    public function createNextRecurring(string $id): Response
    {
        return $this->connector->send(new CreateNextRecurringInvoiceRequest($id));
    }

    /**
     * Get the sequence and number for the next invoice.
     *
     * @return Response Returns {sequence, number}.
     */
    public function nextInfo(?string $issuedAt = null): Response
    {
        return $this->connector->send(new NextInvoiceInfoRequest($issuedAt));
    }

    /**
     * Add expenses to an invoice
     *
     * @param  array<int, string>  $expenseIds  Hashed expense ids.
     */
    public function addExpenses(string $id, array $expenseIds): Response
    {
        return $this->connector->send(new AddExpensesToInvoiceRequest($id, $expenseIds));
    }

    /**
     * Add products to an invoice
     *
     * @param  array<int, string>  $productIds  Hashed product ids.
     */
    public function addProducts(string $id, array $productIds, ?int $beforeOrder = null): Response
    {
        return $this->connector->send(new AddProductsToDocumentRequest('invoice', $id, $productIds, $beforeOrder));
    }

    /**
     * Add rates to an invoice
     *
     * @param  array<int, array{id: string, quantity: float}>  $rates  Each entry is
     *         ['id' => hashedRateId, 'quantity' => float].
     */
    public function addRates(string $id, array $rates, ?int $beforeOrder = null): Response
    {
        return $this->connector->send(new AddRatesToDocumentRequest('invoice', $id, $rates, $beforeOrder));
    }
}
