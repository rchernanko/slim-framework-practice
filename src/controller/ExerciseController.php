<?php

namespace SlimPractice\Controller;

use SlimPractice\EntityRepository\ExerciseRepository;
use SlimPractice\EntityRepository\UserRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class ExerciseController
{
    /** @var  ExerciseRepository */
    private $exerciseRepository;
    /** @var  UserRepository */
    private $userRepository;

    /**
     * ExerciseController constructor.
     * @param ExerciseRepository $exerciseRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ExerciseRepository $exerciseRepository, UserRepository $userRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Endpoint to get all exercises
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getExercises(Request $request, Response $response)
    {
        $exercises = $this->exerciseRepository->findAll();

        if (empty($exercises)) {
            return $response->withJson(['status' => 'error', 'error' => 'No exercises found'], 404);
        }

        if (array_key_exists('Error', $exercises)) {
            return $response->withJson(['status' => 'error', 'error' => $exercises['Error']], 500); //Server side error, hence the 500
        }

        return $response->withJson($exercises, 200);
    }

    /**
     * Endpoint to get a specific exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');

        if (!is_numeric($exerciseId)) {
            return $response->withJson(['status' => 'error', 'error' => 'Request parameter should be an integer'], 400);
        }

        $exercises = $this->exerciseRepository->find($exerciseId);

        if (empty($exercises)) {
            return $response->withJson(['status' => 'error', 'error' => 'No exercises found'], 404);
        }

        if (array_key_exists('Error', $exercises)) {
            return $response->withJson(['status' => 'error', 'error' => $exercises['Error']], 500);
        }

        return $response->withJson($exercises, 200);
    }

    /**
     * Endpoint to delete an exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function deleteExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');

        if (!is_numeric($exerciseId)) {
            return $response->withJson(['status' => 'error', 'error' => 'Request parameter should be an integer'], 400);
        }

        $queryResponse = $this->exerciseRepository->delete($exerciseId);

        if (array_key_exists('NoExerciseError', $queryResponse)) {
            return $response->withJson(['status' => 'error', 'error' => $queryResponse['NoExerciseError']], 404);
        }

        if (array_key_exists('Error', $queryResponse)) {
            return $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);
        }

        return $response->withJson(['status' => 'ok', 'message' => $queryResponse['Success']], 200);
    }

    /**
     * Endpoint to save a new exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function saveExercise(Request $request, Response $response)
    {
        if (!isset($request->getParsedBody()['author']) || !isset($request->getParsedBody()['text'])) {
            return $response->withJson(['status' => 'error', 'error' => 'At least 1 body parameter missing or incorrect'], 400);
        }

        $requestParams['author'] = $request->getParsedBody()['author'];
        $requestParams['text'] = $request->getParsedBody()['text'];

        if (empty($request->getParsedBody()['author']) || empty($request->getParsedBody()['text'])) {
            return $response->withJson(['status' => 'error', 'error' => 'Body parameters cannot be empty'], 400);
        }

        $queryResponse = $this->exerciseRepository->save($requestParams);

        //TODO do i need the below??? Chat with Florent
//        if (empty($queryResponse)) {
//            return $response->withJson("Exercise has not been saved", 404);
//        }

        if (array_key_exists('Error', $queryResponse)) {
            return $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);
        }

        return $response->withJson(['status' => 'ok', 'message' => $queryResponse['Success']], 200);
    }

    /**
     * Endpoint to update an existing exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function updateExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');

        if (!is_numeric($exerciseId)) {
            return $response->withJson(['status' => 'error', 'error' => 'Request parameter should be an integer'], 400);
        }

        if (!isset($request->getParsedBody()['author']) || !isset($request->getParsedBody()['text'])) {
            return $response->withJson(['status' => 'error', 'error' => 'At least 1 body parameter missing'], 400);
        }

        if (empty($request->getParsedBody()['author']) || empty($request->getParsedBody()['text'])) {
            return $response->withJson(['status' => 'error', 'error' => 'Body parameters cannot be empty'], 400);
        }

        $requestParams['author'] = $request->getParsedBody()['author'];
        $requestParams['text'] = $request->getParsedBody()['text'];

        $queryResponse = $this->exerciseRepository->update($exerciseId, $requestParams);

        if (array_key_exists('Error', $queryResponse)) {
            return $response->withJson(['status' => 'error', 'error' => $queryResponse['Error']], 500);
        }

        if (empty($queryResponse)) {
            return $response->withJson(['status' => 'error', 'error' => "Exercise with exerciseId $exerciseId does not exist and so cannot be updated"], 404);
        }

        return $response->withJson(['status' => 'ok', 'message' => $queryResponse['Success']], 200);
    }
}