<?php

namespace StrawBlond\Resources;

use Saloon\Http\Connector;
use Saloon\Http\Response;
use StrawBlond\Resources\CrudResource;

class DocumentElementResource extends CrudResource
{
    public function __construct(
        readonly protected Connector $connector,
        readonly protected string $documentType,
        readonly protected string $documentId
    )
    {}

    protected function getResource(): string
    {
        return 'document_element';
    }

    public function all(array $filters = [], array $include = [], ?string $sort = null, int $page = 1): Response
    {
        return parent::all(
            [...$filters, 'document_type' => match ($this->documentType) {
                'invoice' => 'Modules\Salesforce\Invoice',
                'offer' => 'Modules\Salesforce\Offer',
            }, 'document_id' => $this->documentId], 
            $include, 
            $sort, 
            $page
        );
    }
}
