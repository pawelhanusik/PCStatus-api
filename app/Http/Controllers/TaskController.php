<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Validation\Rule;

class TaskController extends StatusModelController
{
    protected static $storeValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['required', 'string', 'max:125'],
        'status' => ['sometimes', 'required', Rule::in(TaskStatusEnum::toArray())],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $updateValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['sometimes', 'required', 'string', 'max:125'],
        'status' => ['sometimes', 'required', Rule::in(TaskStatusEnum::toArray())],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $modelClass = Task::class;
    protected static $modelResourceClass = TaskResource::class;
}
