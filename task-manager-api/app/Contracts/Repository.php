<?php

namespace App\Repositories\Contracts;

interface Repository
{
    public function all(): iterable;
    public function find(int $id);
    public function create(array $data);
    public function update($entity, array $data): bool;
    public function delete($entity): bool;
}
