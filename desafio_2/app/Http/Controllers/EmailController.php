<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\CreateEmailRequest;
use App\Http\Requests\Email\UpdateEmailRequest;
use App\Services\EmailService;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends Controller
{
    private $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        try {
            $emails = $this->emailService->index();
            return response()->json($emails);
        } catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);

            return response()->json($email);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreateEmailRequest $request)
    {
        try {
            $data = $request->all();
            $email = $this->emailService->create($data);

            return response()->json($email);
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateEmailRequest $request, $uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);

            $data = $request->all();
            $this->emailService->update($email->id, $data);

            return response()->json('Email updated');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($uuid)
    {
        try {
            $email = $this->emailService->getByUuid($uuid);

            $this->emailService->delete($email->id);

            return response()->json('Email removed');
        }catch (Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
