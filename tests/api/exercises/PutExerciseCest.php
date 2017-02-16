<?php

namespace SlimPractice\Tests;

use ApiTester;
use Codeception\Util\HttpCode;

class PutExerciseCest
{
    public function testPutExercise_ValidRequest_ReturnSuccess(ApiTester $I)
    {
        $I->wantToTest('valid request to update an exercise');
        $I->sendPut('/exercises/11', ['author' => 'James Bond', 'text' => 'I do not fancy moneypenny anymore']);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'message' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'ok',
            'message' => 'Exercise with exerciseId = 11 updated'
        ]);
        $I->sendGET('/exercises/11');
        $I->seeResponseContainsJson([
            'exerciseId' => 11,
            'exerciseAuthor' => 'James Bond',
            'exerciseText' => 'I do not fancy moneypenny anymore'
        ]);
    }

    public function testPutExercise_InvalidUrlPath_ReturnError(ApiTester $I)
    {
        $I->wantToTest('invalid request to update specific exercise');
        $I->sendPUT('/exercises/1shirt', ['author' => 'James Bond', 'text' => 'I do not fancy moneypenny anymore']);
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

    public function testPutExercise_MissingBodyParamAuthor_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to update exercise with missing body param \'author\'');
        $I->sendPUT('/exercises/11', ['text' => 'I fancy Moneypenny']);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'At least 1 body parameter missing or incorrect'
        ]);
    }

    public function testPutExercise_MissingBodyParamText_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with missing body param \'text\'');
        $I->sendPUT('/exercises/11', ['author' => 'James Bond']);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'At least 1 body parameter missing or incorrect'
        ]);
    }

    public function testPutExercise_EmptyBodyParam_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with empty body param');
        $I->sendPUT('/exercises/11', ['author' => 'James Bond', 'text' => '']);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'Body parameters cannot be empty'
        ]);
    }

    public function testPutExercise_BodyParamSpeltIncorrectly_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with an incorrectly spelt body param');
        $I->sendPUT('/exercises/11', ['author' => 'James Bond', 'test' => 'Hello this is a test']);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'At least 1 body parameter missing or incorrect'
        ]);
    }
}