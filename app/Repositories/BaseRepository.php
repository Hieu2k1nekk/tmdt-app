<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }


    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }


        public function create(array $attributes)
    {
        DB::beginTransaction();
        try {
            $result = $this->model->create($attributes);
            DB::commit();
            return $result;
        } catch (\Illuminate\Database\QueryException $exception) {
            DB::rollBack();
            $error["error"] = $exception->errorInfo;
            $error["request"] = $attributes;
            Log::error($error["error"]);
            Log::error($error["request"]);
            return redirect(back())->withErrors($exception->getMessage());
        }
    }

    public function update($id, $attributes)
    {

        $result = $this->model->find($id);
        if ($result) {
            DB::beginTransaction();
            try {
                $return = $result->update($attributes);
                DB::commit();
                return $return;
            } catch (\Illuminate\Database\QueryException $exception) {
                DB::rollBack();
                Log::error($exception->errorInfo);
                Log::error($attributes);
                return $exception->getMessage();
            }
        }
        return false;
    }


    public function delete($id)
    {
        $result = $this->model->find($id);
        if ($result) {

            DB::beginTransaction();
            try {
                $result->fill(["is_deleted" => 1, "deleted_at" => date("Y-m-d G:i:s")]);
                $result->save();
                $result->delete();
                DB::commit();
                return true;
            } catch (\Illuminate\Database\QueryException $exception) {
                DB::rollBack();
                Log::error($exception->errorInfo);

                return redirect(back())->withErrors($exception->getMessage());
            }
        }
        return false;
    }
}
