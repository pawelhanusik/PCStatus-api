<?php

namespace App\Http\Controllers;

use App\Models\StatusModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class StatusModelController extends ApiController
{
    protected static $storeValidationRules = [];
    protected static $updateValidationRules = [];
    protected static $modelClass = StatusModel::class;
    protected static $modelResourceClass = JsonResource::class;

    public function index()
    {
        $this->authorize('viewTheirs', static::$modelClass);

        return static::$modelResourceClass::collection(
            auth()->user()->computers
        );
    }

    public function show($modelId)
    {
        $model = static::$modelClass::find($modelId);
        if (is_null($model)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($model);

        return new static::$modelResourceClass($model);
    }

    public function store(Request $request)
    {
        $this->authorize(static::$modelClass);

        $validator = Validator::make($request->all(), static::$storeValidationRules);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $validated['user_id'] = auth()->user()->id;

        static::$modelClass::create($validated);
        return $this->api_ok();
    }

    public function update(Request $request, $modelId)
    {
        $model = static::$modelClass::find($modelId);
        if (is_null($model)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($model);

        $validator = Validator::make($request->all(), static::$updateValidationRules);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $model->update($validated);
        return $this->api_ok();
    }

    public function destroy($modelId)
    {
        $model = static::$modelClass::find($modelId);
        if (is_null($model)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($model);
        
        $model->delete();
        return $this->api_ok();
    }
}
