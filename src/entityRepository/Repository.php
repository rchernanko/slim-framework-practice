<?php

namespace SlimPractice\EntityRepository;

use Slim\Container;

abstract class Repository implements RepositoryInterface
{
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