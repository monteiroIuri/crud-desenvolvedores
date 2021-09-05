<?php

namespace App\Services;

use App\Repositories\DeveloperRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeveloperService
{
    /**
     * @var DeveloperRepository
     */
    protected $repository;

    public function __construct(DeveloperRepository $r)
    {
        $this->repository = $r;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->repository->index();
        return response()->json(["status" => 200, "data" => $data], 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($request)
    {
        $data = $request->all();
        $validateFields = $this->validateFields($data);

        if (count($validateFields)) {
            return response()->json($validateFields, 400);
        }

        try {
            $this->repository->store($data);
            return response()->json(["status" => 201, "message" => "Developer successfully created"], 201);
        } catch (\Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()], 500);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->repository->show($id);

        if (!count($data)) {
            return response(["status" => 404, "message" => "Developer not found"], 404);
        }

        return response()->json(["status" => 200, "data" => $data], 200);
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($request, $id)
    {
        $data = [
            'nome' => $request->input('nome'),
            'sexo' => $request->input('sexo'),
            'idade' => $request->input('idade'),
            'hobby' => $request->input('hobby'),
            'datanascimento' => $request->input('datanascimento')
        ];

        $validateFields = $this->validateFields($data);

        if (count($validateFields)) {
            return response()->json($validateFields, 400);
        }

        try {
            $this->repository->update($data, $id);
            return response()->json(["status" => 200, "message" => "Developer successfully updated"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        if (!count($this->repository->show($id))) {
            return response(["status" => 404, "message" => "Developer not found"], 404);
        }

        try {
            $this->repository->destroy($id);
            return response()->json(["status" => 204, "message" => "Developer deleted successfully"], 204);
        } catch (\Exception $e) {
            return response()->json(["status" => 500, "message" => $e->getMessage()], 500);
        }
    }

    /**
     * @param $data
     * @return array
     */
    private function validateFields($data)
    {
        $validator = Validator::make($data, [
            'nome' => 'required|min:3|max:220',
            'sexo' => 'required|size:1',
            'idade' => 'required|integer',
            'hobby' => 'required|max:140',
            'datanascimento' => 'required|date',
        ]);

        if ($validator->errors()->count()) {
            return ["status" => 400, "message" => $validator->errors()];
        }

        return [];
    }
}
