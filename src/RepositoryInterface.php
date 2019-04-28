<?php


namespace Salemcode8\Repository;


interface RepositoryInterface
{

    public function all();

    public function find($id);

    public function create(array $data);

    public function update($io, array $id);

    public function destroy($id);

    public function modelData();
}
