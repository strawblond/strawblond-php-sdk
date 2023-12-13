<?php

namespace StrawBlond\Resources;

use StrawBlond\Resources\CrudResource;

class ProjectResource extends CrudResource
{
    protected function getResource(): string
    {
        return 'project';
    }
}
