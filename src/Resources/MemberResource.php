<?php

namespace StrawBlond\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use StrawBlond\Requests\AllResourceRequest;
use StrawBlond\Requests\GetResourceRequest;

class MemberResource extends BaseResource
{
    /**
     * Get an member
     */
    public function get(string $id, array $include = []): Response
    {
        return $this->connector->send(new GetResourceRequest('member', $id, $include));
    }

    /**
     * Get all members
     */
    public function all(array $filters = [], array $include = [], string $sort = null, int $page = 1): Response
    {
        return $this->connector->send(new AllResourceRequest('member', $filters, $include, $sort, $page));
    }
}
