<?php

namespace App\Entities;

class Contact extends Entity
{
    public string $name;
    public string $contact;
    public string $email;
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $deleted_at;

    public function __construct(int $id, string $name, string $contact, string $email, string $created_at = null, string $updated_at = null, string $deleted_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->contact = $contact;
        $this->email = $email;
        $this->created_at = $created_at ?? date('Y-m-d H:i:s');
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public static function fromArray(array $data)
    {
        return new Self(
            $data['id'], 
            $data['name'], 
            $data['contact'],
            $data['email'],
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null,
            $data['deleted_at'] ?? null,
        );
    }
}
