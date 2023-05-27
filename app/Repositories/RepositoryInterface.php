<?php

namespace App\Repositories;

use stdClass;

interface RepositoryInterface
{
    public function fromId(int $id);

    public function delete(int $id); 
}