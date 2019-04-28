<?php


namespace SalemCode8\Repository;


interface RepositoryInterface
{

    public function all();

    public function find($id);

    public function where($column, $operator);
    public function create(array $data);

    public function update($io, array $id);

    public function destroy($id);

    public function modelData();

    public function active();
}
