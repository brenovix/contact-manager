<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use stdClass;

abstract class Repository implements RepositoryInterface
{
    protected string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->query();
    }

    public function __invoke()
    {
        $this->query();
    }

    public function query(bool $includeAlias = true): Builder
    {
        $alias = $includeAlias ? strtoupper(substr($this->table, 0, 1)) : null;
        return DB::table($this->table, $alias);
    }

    public function fromId($id)
    {
        return $this->query()->where('id', $id)->first();
    }

    public function delete(int $id)
    {
        $this->query(false)->where('id', $id)->update(['deleted_at' => DB::raw('now()')]);
    }

    public function insert(array $data)
    {
        $data = $this->filterDataInsert($data);
        $id = $this->query(false)->insertGetId($data);
        return $this->fromId($id);
    }
    
    public function update(array $data)
    {
        $id = $data['id'];
        $this->query()->where('id', $id)->update($data);
        return $this->fromId($id);
    }

    public function getAll()
    {
        return $this->query()->whereNull('deleted_at')->get();
    }

    private function filterDataInsert(array $data)
    {
        return array_filter($data, fn ($item) => !empty($item) && strlen($item) > 0);
    }
}