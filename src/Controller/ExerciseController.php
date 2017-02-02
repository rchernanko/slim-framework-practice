<?php

namespace BusuuTest\Controller;

use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
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
            return $response->withJson(['msg' => 'No exercises found'], 404);
        }

        if (array_key_exists('Error', $exercises)) {
            return $response->withJson(['msg' => $exercises['Error']], 400);
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
            return $response->withJson(['msg' => 'Request parameter should be an integer'], 400);
        }

        $exercises = $this->exerciseRepository->find($exerciseId);

        if (empty($exercises)) {
            return $response->withJson(['msg' => 'No exercises found'], 404);
        }

        if (array_key_exists('Error', $exercises)) {
            return $response->withJson(['msg' => $exercises['Error']], 400);
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
            return $response->withJson(['msg' => 'Request parameter should be an integer'], 400);
        }

        $queryResponse = $this->exerciseRepository->delete($exerciseId);

        if (empty($queryResponse)) {
            return $response->withJson(['msg' => "Exercise with exerciseId $exerciseId does not exist and so cannot be deleted"], 404);
        }

        if (array_key_exists('Error', $queryResponse)) {
            return $response->withJson(['msg' => $queryResponse['Error']], 400);
        }

        return $response->withJson($queryResponse, 200);
    }

    /**
     * Endpoint to save a new exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function saveExercise(Request $request, Response $response)
    {
        if (!isset($request->getParsedBody()['author']) || !isset($request->getParsedBody()['exerciseText'])) {
            return $response->withJson(['msg' => 'At least 1 body parameter missing'], 400);
        }

        $requestParams['author'] = $request->getParsedBody()['author'];
        $requestParams['exerciseText'] = $request->getParsedBody()['exerciseText'];

        $queryResponse = $this->exerciseRepository->save($requestParams);

        if (empty($queryResponse)) {
            return $response->withJson("Exercise has not been saved", 404);
        }

        if (array_key_exists('Error', $queryResponse)) {
            return $response->withJson(['msg' => $queryResponse['Error']], 400);
        }

        return $response->withJson($queryResponse, 200);
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
            return $response->withJson(['msg' => 'Request parameter should be an integer'], 400);
        }

        if (!isset($request->getParsedBody()['author']) || !isset($request->getParsedBody()['exerciseText'])) {
            return $response->withJson(['msg' => 'At least 1 body parameter missing'], 400);
        }

        $requestBodyParams['author'] = $request->getParsedBody()['author'];
        $requestBodyParams['exerciseText'] = $request->getParsedBody()['exerciseText'];


        $exerciseId = $request->getAttribute('id');
        $queryResponse = $this->exerciseRepository->update($exerciseId, $request);

        if (empty($queryResponse)) {
            return $response->withJson("Exercise has not been updated", 404);
        }

        return $response->withJson($queryResponse, 200);
    }
}