<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface {

    public function get($data);
    public function getId($id);
    public function store($data);
    public function update($data, $id);
    public function destroy($id);
}
