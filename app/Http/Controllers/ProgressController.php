<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProgressResource;
use App\Models\Progress;

class ProgressController extends StatusModelController
{
    protected static $storeValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['required', 'string', 'max:125'],
        'progress' => ['sometimes', 'required', 'int'],
        'progress_max' => ['sometimes', 'required', 'int'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $updateValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['sometimes', 'required', 'string', 'max:125'],
        'progress' => ['sometimes', 'required', 'int'],
        'progress_max' => ['sometimes', 'required', 'int'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $modelClass = Progress::class;
    protected static $modelResourceClass = ProgressResource::class;
}
