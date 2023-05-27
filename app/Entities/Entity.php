<?php

namespace App\Entities;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Support\Arrayable;

abstract class Entity implements Arrayable
{
    protected int $id;

    public function toArray(): array
    {
        return json_decode(json_encode(get_object_vars($this)), true);
    }

    public function id(): int
    {
        return $this->id;
    }

    public static function fromId($id, RepositoryInterface $repository)
    {
        $data = $repository->fromId($id);
        return empty($data) ? false : self::fromObject($data);
    }

    abstract static function fromArray(array $data);

    public static function fromJson(string $json)
    {
        $class = get_called_class();
        return $class::fromArray(json_decode($json, true));
    }

    public static function fromObject(object $object)
    {
        $class = get_called_class();
        return $class::fromArray(get_object_vars($object));
    }
}
