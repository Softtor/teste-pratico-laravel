<?php

namespace App\Contracts;

interface RepositoryContract
{
    public function all(array $filters = []): iterable;

    public function find(int $id);

    public function create(array $data);

    public function update($entity, array $data): bool;

    public function delete($entity): bool;
}
