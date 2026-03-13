<?php

namespace Maximianac\SiteBuilder\Services\Managers\Clients;

use Illuminate\Database\Eloquent\Model;

abstract class ModelManager
{
    abstract public function create(array $data): Model;
}
