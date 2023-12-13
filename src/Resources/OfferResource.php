<?php

namespace StrawBlond\Resources;

use Saloon\Http\Response;
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
    public function send(string $id, array $recipients, ?string $message = null, bool $ccToOwner = false): Response
    {
        return $this->connector->send(new SendOfferRequest(...func_get_args()));
    }
}
