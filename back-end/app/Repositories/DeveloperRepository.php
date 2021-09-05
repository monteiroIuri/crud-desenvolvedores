<?php

namespace App\Repositories;

use App\Models\Developer;

class DeveloperRepository
{
    /**
     * @return Developer[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $developers = Developer::all();
        return $developers;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Developer::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $developer = Developer::where('id', $id)->get();
        return $developer;
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return Developer::where('id', $id)->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Developer::where('id', $id)->delete();
    }
}
