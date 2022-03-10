<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends StatusModelController
{
    protected static $storeValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['required', 'string', 'max:125'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $updateValidationRules = [
        'computer_id' => ['sometimes', 'required', 'id', 'exists:computers'],
        'title' => ['sometmes', 'required', 'string', 'max:125'],
        'message' => ['sometimes', 'required', 'string'],
    ];
    protected static $modelClass = Notification::class;
    protected static $modelResourceClass = NotificationResource::class;
}
