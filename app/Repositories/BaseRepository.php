<?php

namespace App\Http\Repositories;

use App\Http\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    //model 処理したい
    protected $model;

    //初期ページ
    public function __construct()
    {
        $this->setModel();
    }

    //当モデルを取る
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    /**
     * すべてデータを取る
     */
    public function getAll()
    {
        return $this->model->all();
    }
    /**
     * モデルを検索する
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }
    /**
     * モデルを作成する
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }
    /**
     * モデルを更新する
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }
    /**
     * モデルを削除する
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
