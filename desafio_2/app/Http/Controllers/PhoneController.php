<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\CreateEmailRequest;
use App\Http\Requests\Email\UpdateEmailRequest;
use App\Http\Requests\Phone\CreatePhoneRequest;
use App\Http\Requests\Phone\UpdatePhoneRequest;
use App\Services\EmailService;
use App\Services\PeopleService;
use App\Services\PhoneService;
use Exception;

class PhoneController extends Controller
{
    private $phoneService;
    private $peopleService;

    public function __construct(
        PhoneService $phoneService,
        PeopleService $peopleService
    )
    {
        $this->phoneService = $phoneService;
        $this->peopleService = $peopleService;
    }

    public function index($uuidPeople)
    {
        try {
            $people = $this->peopleService->getByUuid($uuidPeople);
            throw_if(empty($people), new Exception('People not found', 404));
            return response()->json($people->phones);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function show($uuidPeople, $uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);
            
            throw_if(empty($phone), new Exception('phone not found', 404));
            throw_if($phone->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            return response()->json($phone);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function store(CreatePhoneRequest $request, $uuidPeople)
    {
        try {
            $people = $this->peopleService->getByUuid($uuidPeople);
            throw_if(empty($people), new Exception('People not found', 404));
            
            $data = $request->all();
            $data['people_id'] = $people->id;

            $phone = $this->phoneService->create($data);

            return response()->json($phone);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function update(UpdatePhoneRequest $request, $uuidPeople, $uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);
            
            throw_if(empty($phone), new Exception('phone not found', 404));
            throw_if($phone->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            $data = $request->all();
            $this->phoneService->update($phone->id, $data);

            return response()->json('phone updated');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function destroy($uuidPeople, $uuid)
    {
        try {
            $phone = $this->phoneService->getByUuid($uuid);
            
            throw_if(empty($phone), new Exception('phone not found', 404));
            throw_if($phone->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            $this->phoneService->delete($phone->id);

            return response()->json('phone removed');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }
}
