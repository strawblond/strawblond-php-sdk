<?php

namespace StrawBlond\Resources;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use StrawBlond\Requests\GetUserRequest;
use StrawBlond\Requests\UpdateUserRequest;

class UserResource extends BaseResource
{
    /**
     * Get the current user.
     */
    public function me(): Response
    {
        return $this->connector->send(new GetUserRequest);
    }

    /**
     * Update the current user.
     */
    public function update(array $changes): Response
    {
        return $this->connector->send(new UpdateUserRequest($changes));
    }
}
