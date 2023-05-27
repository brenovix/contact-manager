<?php

namespace App\Entities;

class User extends Entity
{
    public string $name;
    public string $email;
    public string $email_verified_at;
    private string $password;
    public ?string $remember_token;
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $deleted_at;

    public function __construct(int $id, 
        string $name, 
        string $email, 
        string $password, 
        string $email_verified_at = null, 
        string $remember_token = null, 
        string $created_at = null, 
        string $updated_at = null,
        string $deleted_at = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->email_verified_at = $email_verified_at;
        $this->remember_token = $remember_token;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }

    public static function fromArray(array $data)
    {
        return new Self(
            $data['id'], 
            $data['name'], 
            $data['email'],
            $data['password'],
            $data['email_verified_at'] ?? null,
            $data['remember_token'] ?? null,
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null,
            $data['deleted_at'] ?? null,
        );
    }
}
