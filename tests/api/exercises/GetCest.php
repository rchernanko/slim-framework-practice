<?php

namespace BusuuTest\Tests;

use ApiTester;
use Codeception\Util\HttpCode;

class GetCest
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

    public function testGetExercise_InvalidParam_ReturnError(ApiTester $I)
    {
        $I->wantToTest('invalid request param to get specific exercise');
        $I->sendGET('/exercises/1shirt');
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
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
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'No exercises found'
        ]);
    }
}