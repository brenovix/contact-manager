<?php

namespace App\Repositories;

class ContactRepository extends Repository
{
    public function __construct()
    {
        $this->table = 'contacts';
    }
}
