<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputerResource;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComputerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewTheirs', Computer::class);

        return ComputerResource::collection(
            auth()->user()->computers
        );
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($computerId)
    {
        $computer = Computer::find($computerId);
        if (is_null($computer)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($computer);

        return new ComputerResource($computer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize(Computer::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:125',
            'sort' => 'sometimes|required|int'
        ]);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $validated['user_id'] = auth()->user()?->id;

        Computer::create($validated);
        return $this->api_ok();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $computerId)
    {
        $computer = Computer::find($computerId);
        if (is_null($computer)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($computer);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:125',
            'sort' => 'sometimes|required|int'
        ]);
        if ($validator->fails()) {
            return $this->api_fail($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $validated['user_id'] = auth()->user()?->id;

        $computer->update($validated);
        return $this->api_ok();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($computerId)
    {
        $computer = Computer::find($computerId);
        if (is_null($computer)) {
            return $this->api_fail(null, 404);
        }

        $this->authorize($computer);
        
        $computer->delete();
        return $this->api_ok();
    }
}
