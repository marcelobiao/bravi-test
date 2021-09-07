<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\People\CreatePeopleRequest;
use App\Services\PeopleService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PeopleController extends Controller
{
    
    private $peopleService;

    public function __construct(PeopleService $peopleService)
    {
        $this->peopleService = $peopleService;
    }

    public function index()
    {
        try {
            $peoples = $this->peopleService->index();
            return response()->json($peoples);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($uuid)
    {
        try {
            $people = $this->peopleService->getByUuid($uuid);

            return response()->json($people);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreatePeopleRequest $request)
    {
        try {
            $data = $request->all();
            $people = $this->peopleService->create($data);

            return response()->json($people);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CreatePeopleRequest $request, $uuid)
    {
        try {
            $people = $this->peopleService->getByUuid($uuid);

            $data = $request->all();
            $this->peopleService->update($people->id, $data);

            return response()->json('People updated');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($uuid)
    {
        try {
            $people = $this->peopleService->getByUuid($uuid);

            $this->peopleService->delete($people->id);

            return response()->json('People removed');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
