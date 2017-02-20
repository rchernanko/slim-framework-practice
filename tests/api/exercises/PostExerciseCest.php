<?php

namespace SlimPractice\Tests;

use ApiTester;
use Codeception\Util\HttpCode;

class PostExerciseCest
{
    public function testPostExercise_ValidRequest_ReturnSuccess(ApiTester $I)
    {
        $I->wantToTest('valid request to post an exercise');
        $I->sendPOST('/exercises', ['author' => 'James Bond', 'text' => 'I fancy Moneypenny']);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'message' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'ok',
            'message' => 'Exercise saved'
        ]);
        $I->sendGET('/exercises/11');
        $I->seeResponseContainsJson([
            'exerciseId' => 11,
            'exerciseAuthor' => 'James Bond',
            'exerciseText' => 'I fancy Moneypenny'
        ]);
    }

    public function testPostExercise_MissingBodyParamAuthor_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with missing body param \'author\'');
        $I->sendPOST('/exercises', ['text' => 'I fancy You']);
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

    public function testPostExercise_MissingBodyParamText_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with missing body param \'text\'');
        $I->sendPOST('/exercises', ['author' => 'James Bond']);
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

    public function testPostExercise_EmptyBodyParam_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with empty body param');
        $I->sendPOST('/exercises', ['author' => 'James Bond', 'text' => '']);
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

    public function testPostExercise_BodyParamSpeltIncorrectly_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with an incorrectly spelt body param');
        $I->sendPOST('/exercises', ['author' => 'richard chernanko', 'test' => 'Hello this is a test']);
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

    /*

    TODO - get this working - need to resolve issues with is_string in the controller

    public function testPostExercise_InvalidBodyParamType_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with invalid body param type');
        $I->sendPOST('/exercises', ['author' => [], 'text' => 'Hello this is a test']);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'status' => 'string',
            'error' => 'string'
        ]);
        $I->seeResponseContainsJson([
            'status' => 'error',
            'error' => 'At least 1 body parameter is of the incorrect type'
        ]);
    }


     TODO for post exercise (add to above)

     $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);

    */
}