<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\CreateEmailRequest;
use App\Http\Requests\Email\UpdateEmailRequest;
use App\Services\EmailService;
use App\Services\PeopleService;
use Exception;

class EmailController extends Controller
{
    private $emailService;
    private $peopleService;

    public function __construct(
        EmailService $emailService,
        PeopleService $peopleService
    )
    {
        $this->emailService = $emailService;
        $this->peopleService = $peopleService;
    }

    public function index($uuidPeople)
    {
        try {
            $people = $this->peopleService->getByUuid($uuidPeople);
            throw_if(empty($people), new Exception('People not found', 404));
            return response()->json($people->emails);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function show($uuidPeople, $uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);
            
            throw_if(empty($email), new Exception('Email not found', 404));
            throw_if($email->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            return response()->json($email);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function store(CreateEmailRequest $request, $uuidPeople)
    {
        try {
            $people = $this->peopleService->getByUuid($uuidPeople);
            throw_if(empty($people), new Exception('People not found', 404));
            
            $data = $request->all();
            $data['people_id'] = $people->id;

            $email = $this->emailService->create($data);

            return response()->json($email);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function update(UpdateEmailRequest $request, $uuidPeople, $uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);
            
            throw_if(empty($email), new Exception('Email not found', 404));
            throw_if($email->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            $data = $request->all();
            $this->emailService->update($email->id, $data);

            return response()->json('Email updated');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function destroy($uuidPeople, $uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);
            
            throw_if(empty($email), new Exception('Email not found', 404));
            throw_if($email->people->uuid != $uuidPeople, new Exception('Not allowed viewing', 403));

            $this->emailService->delete($email->id);

            return response()->json('Email removed');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], $ex->getCode());
        }
    }
}
