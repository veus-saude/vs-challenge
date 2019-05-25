<?php

namespace App\Repositories;

interface CrudContract
{
    public function create($data);

    public function all($query, $filters, $sort = null, $page = null);

    public function find($id);

    public function update($id, $data);

    public function delete($id);
}