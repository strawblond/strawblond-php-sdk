<?php

namespace StrawBlond;

use Saloon\Http\Connector;
use StrawBlond\Resources\CompanyResource;
use StrawBlond\Resources\ContactResource;
use StrawBlond\Resources\DocumentElementResource;
use StrawBlond\Resources\ExpenseResource;
use StrawBlond\Resources\InvoiceResource;
use StrawBlond\Resources\MemberResource;
use StrawBlond\Resources\OfferResource;
use StrawBlond\Resources\ProductResource;
use StrawBlond\Resources\ProjectResource;
use StrawBlond\Resources\RateResource;
use StrawBlond\Resources\TimeResource;
use StrawBlond\Resources\UnitResource;
use StrawBlond\Resources\UserResource;
use StrawBlond\Resources\WebhookResource;

class StrawBlond extends Connector
{
    public function __construct(string $apiKey)
    {
        $this->withTokenAuth($apiKey);
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.strawblond.com/api';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function user(): UserResource
    {
        return new UserResource($this);
    }

    public function invoice(): InvoiceResource
    {
        return new InvoiceResource($this);
    }

    public function offer(): OfferResource
    {
        return new OfferResource($this);
    }

    public function contact(): ContactResource
    {
        return new ContactResource($this);
    }

    public function company(): CompanyResource
    {
        return new CompanyResource($this);
    }

    public function project(): ProjectResource
    {
        return new ProjectResource($this);
    }

    public function timeTracking(): TimeResource
    {
        return new TimeResource($this);
    }

    public function documentElement(string $type, string $id): DocumentElementResource
    {
        return new DocumentElementResource($this, $type, $id);
    }

    public function expense(): ExpenseResource
    {
        return new ExpenseResource($this);
    }

    public function product(): ProductResource
    {
        return new ProductResource($this);
    }

    public function rate(): RateResource
    {
        return new RateResource($this);
    }

    public function unit(): UnitResource
    {
        return new UnitResource($this);
    }

    public function member(): MemberResource
    {
        return new MemberResource($this);
    }

    public function webhook(): WebhookResource
    {
        return new WebhookResource($this);
    }
}
