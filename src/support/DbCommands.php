<?php

namespace SlimPractice\Support;

use Slim\Container;
use Throwable;

class DbCommands
{
    private $container;

    /**
     * DbCommands constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Runs a select sql query
     * @param $query
     * @return array
     */
    public function runSelectQuery($query)
    {
        $queryResults = [];

        $stmt = $this->container['db']->prepare($query);

        try {
            $stmt->execute();
        } catch (Throwable $throwable) {
            $queryResults['Error'] = 'Error when querying the database';
            return $queryResults;
        }

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $queryResults[] = $row;
        }

        return $queryResults;
    }
}