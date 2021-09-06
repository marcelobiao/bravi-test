<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Phone\CreatePhoneRequest;
use App\Http\Requests\Phone\UpdatePhoneRequest;
use App\Services\PhoneService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PhoneController extends Controller
{
    private $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    public function index()
    {
        try {
            $phones = $this->phoneService->index();
            return response()->json($phones);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);

            return response()->json($phone);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreatePhoneRequest $request)
    {
        try {
            $data = $request->all();
            $phone = $this->phoneService->create($data);

            return response()->json($phone);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdatePhoneRequest $request, $uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);

            $data = $request->all();
            $this->phoneService->update($phone->id, $data);

            return response()->json('Phone updated');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);

            $this->phoneService->delete($phone->id);

            return response()->json('Phone removed');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
