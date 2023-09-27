<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Services\GoalService;
use App\Http\Requests\GoalPostRequest;

class GoalController extends Controller
{
    public function overview(Request $request): JsonResponse
    {
        $user_uuid = $request['JWT']['userUid'];
        $result = GoalService::getUserGoals($user_uuid);
        return new JsonResponse($result, 200);
    }

    public function details(Request $request, string $uuid): JsonResponse
    {
        $user_uuid = $request['JWT']['userUid'];
        $result = GoalService::getUserGoal($user_uuid, $uuid);
        return new JsonResponse($result, 200);
    }

    public function create(GoalPostRequest $request): JsonResponse
    {
        $user_uuid = $request['JWT']['userUid'];
        $data = $request->input('data');
        $result = GoalService::createUserGoal($user_uuid, $data);
        return new JsonResponse($result, 200);
    }

    public function edit(Request $request, string $uuid): JsonResponse
    {
        $user_uuid = $request['JWT']['userUid'];
        $data = $request->input('data');
        $result = GoalService::editGoal($user_uuid, $uuid, $data);
        return new JsonResponse($result, 200);
    }

    public function delete(Request $request, string $uuid): JsonResponse
    {
        $user_uuid = $request['JWT']['userUid'];
        $result = GoalService::deleteGoal($user_uuid, $uuid);
        return new JsonResponse($result, 200);
    }
}
