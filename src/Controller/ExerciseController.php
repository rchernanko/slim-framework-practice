<?php

namespace BusuuTest\Controller;

use BusuuTest\Entity\Exercise;
use BusuuTest\Entity\Vote;
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
     * Endpoint to create an exercise. An exercise contains text submitted by a user.
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function createExercise(Request $request, Response $response, $args)
    {
        $data = json_decode($request->getBody());
        $userId = $args['userId'];

        // Check parameter validity
        if (empty($data->text)) {
            return $response->withJson(['msg' => 'Text is missing!'], 400);
        }

        //TODO - Understand - why do I need this when it is injected into the container?
        $userRepository = new UserRepository();
        $exerciseRepository = new ExerciseRepository();

        // Create exercise
        $exercise = new Exercise(new Vote()); //TODO mmm, should be handled by my DI container...Read up on and amend
        $exercise->setText($data->text);
        $exercise->setAuthor($userRepository->find($userId));
        $exerciseRepository->save($exercise);

        // Return response
        return $response->withJson(['status' => 'ok']);
    }

    /**
     * Endpoint to submit a vote on an exercise.
     * A vote can either be positive (thumbs up) or negative (thumbs down).
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function submitVote(Request $request, Response $response, $args)
    {
        //Get HTTP request body
        $data = json_decode($request->getBody());

        //Retrieve key from the HTTP request body
        $voteType = $data->isPositiveVote;

        //Check validity of voteType
        //Using isset because empty would return true if isPositiveVote = false
        if (isset($voteType)) {
            return $response->withJson(['msg' => 'Vote type missing'], 400);
        }

        //Retrieve key from the HTTP request body
        $userId = $data->userId;

        //Check validity of userId
        if (empty($userId)) {
            return $response->withJson(['msg' => 'Invalid user id'], 400);
        }

        //Get the exerciseId from HTTP request params
        $exerciseId = $args['exerciseId'];

        //Check validity of exerciseId
        if (empty($exerciseId)) {
            return $response->withJson(['msg' => 'Invalid exercise id'], 400);
        }

        //Retrieve exercise from repository
        $exerciseRepository = new ExerciseRepository();
        $exercise = $exerciseRepository->find($exerciseId);

        //Check exercise is returned - Perhaps this could be handled in the ExerciseRepository class
        if (empty($exercise)) {
            return $response->withJson(['msg' => 'Exercise not found'], 404);
        }

        //Get the vote object for this exercise
        $exerciseVotes = $exercise->getVote();

        //Update total votes
        $exerciseVotes->setTotalVotes($exerciseVotes->getTotalVotes() + 1);

        //Update total positive / negative votes and add userId to the array
        if ($voteType) {
            $exerciseVotes->setTotalPositiveVotes($exerciseVotes->getTotalPositiveVotes() + 1);
            $exerciseVotes->addUserIdToArray($userId);
        } else {
            $exerciseVotes->setTotalNegativeVotes($exerciseVotes->getTotalNegativeVotes() + 1);
            $exerciseVotes->addUserIdToArray($userId);
        }

        $exerciseRepository->save($exercise);

        // Return response

        $totalPositiveVotes = $exerciseVotes->getTotalPositiveVotes(); //TODO not sure why I can't put this in the below
        return $response->withJson(
            "['status' => 'ok', 'data' => ['totalVotes' => '$exerciseVotes', 'totalPositiveVotes' => $totalPositiveVotes']");

        //TODO is there any abstraction I can now do?
    }
}