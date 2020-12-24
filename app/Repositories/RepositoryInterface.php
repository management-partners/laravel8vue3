<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    /**
     * 全てデータを取る
     * @return mixed
     */
    public function getAll();

    /**
     * 1モデルを検索する
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * 新しいモデルを作成する
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * モデルを更新する
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * モデルを削除する
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
