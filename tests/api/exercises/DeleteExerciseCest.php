<?php

namespace SlimPractice\Tests;

use ApiTester;
use Codeception\Util\HttpCode;

class DeleteExerciseCest
{
    public function testDeleteExercises_DeleteAll_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to delete all exercises');
        $I->sendDELETE('/exercises');
        $I->seeResponseCodeIs(HttpCode::METHOD_NOT_ALLOWED);
    }

    public function testDeleteExercises_DeleteExerciseThatExists_ReturnSuccess(ApiTester $I)
    {
        $I->wantToTest('delete an existing exercise');
        $I->sendDELETE('/exercises/1');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'message' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'ok',
            'message' => 'Exercise with exerciseId = 1 deleted'
        ]);
    }

    public function testDeleteExercise_InvalidUrlPath_ReturnError(ApiTester $I)
    {
        $I->wantToTest('invalid request to delete specific exercise');
        $I->sendDELETE('/exercises/shirt');
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'Request parameter should be an integer'
        ]);
    }

    public function testDeleteExercise_ExerciseDoesNotExist_ReturnError(ApiTester $I)
    {
        $I->wantToTest('delete an exercise that does not exist');
        $I->sendDELETE('/exercises/20');
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'Exercise to delete does not exist'
        ]);
    }

    /*
     * TODO for delete exercises (add to above)
     *
     * if (array_key_exists('Error', $queryResponse)) {
     *    return $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);}
     */
}