<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;
/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();

    public function create(array $attributes);

    public function find($id);

    public function update($id, $attributes);

    public function delete($id);
}
