<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
use StrawBlond\Requests\ArchiveOfferRequest;
use StrawBlond\Requests\CompleteOfferBillingRequest;
use StrawBlond\Requests\ReopenOfferBillingRequest;
use StrawBlond\Requests\SendOfferRequest;
use StrawBlond\Resources\CrudResource;

class OfferResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'offer';
    }

    /**
     * Get the document element resource for an offer
     */
    public function lineItems(string $offerId): DocumentElementResource
    {
        return new DocumentElementResource($this->connector, 'offer', $offerId);
    }

    /**
     * Send an offer
     */
    public function send(string $id, array $recipients, ?string $message = null, bool $ccToOwner = false, array $attachments = []): Response
    {
        return $this->connector->send(new SendOfferRequest($id, $recipients, $message, $ccToOwner, $attachments));
    }

    /**
     * Archive an offer
     */
    public function archive(string $id, ?string $reason = null): Response
    {
        return $this->connector->send(new ArchiveOfferRequest($id, $reason));
    }

    /**
     * Complete billing for an offer
     */
    public function completeBilling(string $id, ?string $reason = null): Response
    {
        return $this->connector->send(new CompleteOfferBillingRequest($id, $reason));
    }

    /**
     * Reopen billing for an offer
     */
    public function reopenBilling(string $id): Response
    {
        return $this->connector->send(new ReopenOfferBillingRequest($id));
    }
}
