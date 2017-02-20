<?php

namespace SlimPractice\Tests;

use ApiTester;
use Codeception\Util\HttpCode;

class GetExerciseCest
{
    public function testGetExercises_ExercisesExist_ReturnAllExercises(ApiTester $I)
    {
        $I->wantToTest('valid request to get all exercises');
        $I->sendGET('/exercises');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'exerciseId' => 'integer',
            'exerciseAuthor' => 'string',
            'exerciseText' => 'string'
        ]);
    }

    /*
     * TODO for get all exercises (add to above)
     *
     * return $response->withJson(['status' => 'error', 'error' => 'No exercises found'], 404);
     *
     * return $response->withJson(['status' => 'error', 'error' => $exercises['Error']], 500); //Server side error, hence the 500
     */

    public function testGetExercise_ExerciseExists_ReturnExercise(ApiTester $I)
    {
        $I->wantToTest('valid request to get a specific exercise');
        $I->sendGET('/exercises/3');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'exerciseId' => 'integer',
            'exerciseAuthor' => 'string',
            'exerciseText' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'exerciseId' => 3,
            'exerciseAuthor' => 'Metallica',
            'exerciseText' => 'For whom the bell tolls...time marches on woo'
        ]);
    }

    public function testGetExercise_InvalidUrlPath_ReturnError(ApiTester $I)
    {
        $I->wantToTest('invalid request to get specific exercise');
        $I->sendGET('/exercises/1shirt');
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

    public function testGetExercise_NoExerciseFound_ReturnError(ApiTester $I)
    {
        $I->wantToTest('no exercise found');
        $I->sendGET('/exercises/11');
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'No exercises found'
        ]);
    }

    /*
    * TODO for get specific exercises (add to above)
    *
    * return $response->withJson(['status' => 'error', 'error' => $exercises['Error']], 500);
    *
    */

}