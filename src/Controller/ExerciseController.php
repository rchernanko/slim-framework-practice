<?php

namespace BusuuTest\Controller;

use BusuuTest\Entity\Exercise;
use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use Slim\Container;
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
        return $this->exerciseRepository->findAll($response);
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
        return $this->exerciseRepository->find($exerciseId, $response);
    }

    /**
     * Endpoint to delete a specific exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function deleteExercise(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');
        return $this->exerciseRepository->delete($id, $response);
    }

    /**
     * Endpoint to save a new exercise to the db
     * @param Request $request
     * @param Response $response
     * @return mixed|Response
     */
    public function saveExercise(Request $request, Response $response)
    {
        return $this->exerciseRepository->save($request, $response);
    }

    /**
     * Endpoint to update an already existing exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function updateExercise(Request $request, Response $response)
    {
        return $this->exerciseRepository->update($request, $response);
    }

    //TODO i think the below starts to build on ORM...come back to this as I should be using this instead of the above...
    /**
     * Endpoint to create an exercise. An exercise contains text submitted by a user.
     */
//    public function createExercise(Request $request, Response $response, $args)
//    {
//        $data = json_decode($request->getBody());
//        $userId = $args['userId'];
//
//        // Check parameter validity
//        if (empty($data->text)) {
//            return $response->withJson(['msg' => 'Text is missing!'], 400);
//        }
//
//        $userRepository = new UserRepository();
//        $exerciseRepository = new ExerciseRepository();
//
//        // Create exercise
//        $exercise = new Exercise();
//        $exercise->setText($data->text);
//        $exercise->setAuthor($userRepository->find($userId));
//        $exerciseRepository->save($exercise);
//
//        // Return response
//        return $response->withJson(['status' => 'ok']);
//    }
}