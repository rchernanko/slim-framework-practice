<?php

namespace SlimPractice\EntityRepository;

use Slim\Container;

abstract class Repository implements RepositoryInterface
{
    /*
     * TODO think about this. Similar to the ExerciseController, this class doesn't need access to the whole container,
     * TODO just certain things in it (e.g. the db connection) - So re-work so that it only has access to what it needs
     */
    protected $container;

    /**
     * Repository constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}