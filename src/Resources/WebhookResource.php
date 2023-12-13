<?php

namespace StrawBlond\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use StrawBlond\Requests\AllResourceRequest;
use StrawBlond\Requests\CreateResourceRequest;
use StrawBlond\Requests\DeleteResourceRequest;
use StrawBlond\Requests\GetResourceRequest;
use StrawBlond\Requests\UpdateResourceRequest;

class WebhookResource extends BaseResource
{
    public function create(string $event, string $url): Response
    {
        return $this->connector->send(new CreateResourceRequest('webhook', [
            'event' => $event,
            'url' => $url,
        ]));
    }

    public function get(string $id): Response
    {
        return $this->connector->send(new GetResourceRequest('webhook', $id));
    }

    public function all(): Response
    {
        return $this->connector->send(new AllResourceRequest('webhook'));
    }

    public function update(string $id, string $event, string $url): Response
    {
        return $this->connector->send(new UpdateResourceRequest('webhook', $id, [
            'event' => $event,
            'url' => $url,
        ]));
    }

    public function delete(string $id): Response
    {
        return $this->connector->send(new DeleteResourceRequest('webhook', $id));
    }
}
