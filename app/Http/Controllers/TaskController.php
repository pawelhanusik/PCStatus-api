<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends StatusModelController
{
    protected static $storeValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['required', 'string', 'max:125'],
        'status' => ['sometimes', 'required'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $updateValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['sometimes', 'required', 'string', 'max:125'],
        'status' => ['sometimes', 'required'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $modelClass = Task::class;
    protected static $modelResourceClass = TaskResource::class;

    public function store(Request $request) {
        $validator = Validator::make($request->all('status'), [
            'status' => Rule::in(TaskStatusEnum::toArray())
        ]);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        return parent::store($request);
    }
    public function update(Request $request, $modelId) {
        $validator = Validator::make($request->all('status'), [
            'status' => Rule::in(TaskStatusEnum::toArray())
        ]);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        return parent::update($request, $modelId);
    }
}
