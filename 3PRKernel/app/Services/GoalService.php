<?php

namespace App\Services;

use App\Models\Goal;


class GoalService {
	
	public static function getUserGoals(string $uuid) : array {
		return Goal::where('user_uuid', '=', $uuid)->get()->toArray();
	}

	public static function getUserGoal(string $user_uuid, string $goal_uuid) : array {
		$goal = Goal::where('user_uuid', '=', $user_uuid)
			->where('uuid', '=', $goal_uuid)
			->first();
		if ($goal === null) {
			return ['error' => 'No Goal found'];
		}
		return $goal->toArray();
	}

	public static function createUserGoal(string $user_uuid, array $data) : string {
		$newData = $data + ['user_uuid' => $user_uuid];
		$newGoal = Goal::create($newData);
		return $newGoal->uuid;
	}

	public static function editGoal(string $user_uuid, string $goal_uuid, array $data) : array {

		$goal = Goal::where('user_uuid', '=', $user_uuid)
			->where('uuid', '=', $goal_uuid)
			->first();

		if ($goal === null) {
			return ['error' => 'No Goal found'];
		}

		$goal->fill($data)->save();

		return $goal->toArray();
	}

	public static function deleteGoal(string $user_uuid, string $goal_uuid) : string {
		Goal::where('user_uuid', '=', $user_uuid)
			->where('uuid', '=', $goal_uuid)
			->first()
			->truncate();
		return "OK";
	}

}
