<?php


namespace BusuuTest\Tests;


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
    }

    public function testPostExercise_MissingBodyParamAuthor_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with missing body param \'author\'');
        $I->sendPOST('/exercises', ['text' => 'I fancy Moneypenny']);
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
    * TODO for post exercise (add to above)
    *
    * $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);
    *

    TODO this should fail because the author value is not a string, but an integer...work out more
    public function testPostExercise_InvalidBodyParamType_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with invalid body param type');
        $I->sendPOST('/exercises', ['author' => 123456, 'text' => 'Hello this is a test']);
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

    TODO this should fail because there are too many params...work out more
    public function testPostExercise_TooManyBodyParams_ReturnError(ApiTester $I)
    {
        $I->wantToTest('request to post exercise with too many body params');
        $I->sendPOST('/exercises', ['author' => 'richard chernanko', 'text' => 'Hello this is a test', 'thirdParam' => 'I should not be here']);
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


     */
}