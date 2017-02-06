<?php
namespace BusuuTest\EntityRepository;

use Throwable;

class ExerciseRepository extends Repository
{

    public function findAll()
    {
        $query = "select id as exerciseId, author as exerciseAuthor, text as exerciseText from exercises";
        return $this->runSelectQuery($query);
    }

    public function find($exerciseId)
    {
        $query = "select id as exerciseId, author as exerciseAuthor, text as exerciseText from exercises where id = $exerciseId";
        return $this->runSelectQuery($query);
    }

    public function delete($exerciseId)
    {
        $queryResults = [];

        if(empty($this->find($exerciseId))) {
            $queryResults['Error'] = 'Exercise to delete does not exist';
            return $queryResults;
        }

        $query = "delete from exercises where id = $exerciseId";

        $stmt = $this->container['db']->prepare($query);

        try {
            $stmt->execute();
        } catch (Throwable $throwable) {
            $queryResults['Error'] = 'Error when querying the database';
            return $queryResults;
        }

        if ($stmt->affected_rows == 0) {
            return $queryResults;
        }

        $queryResults[] = "Exercise with exerciseId = $exerciseId deleted";

        return $queryResults;
    }

    public function save($requestParams)
    {
        $query = "INSERT INTO exercises (author, text) VALUES (?,?)";
        $queryResults = [];

        $stmt = $this->container['db']->prepare($query);

        try {
            $stmt->bind_param("ss", $requestParams['author'], $requestParams['text']);
            $stmt->execute();
        } catch (Throwable $throwable) {
            $queryResults['Error'] = 'Error when querying the database';
            return $queryResults;
        }

        if ($stmt->affected_rows == 0) {
            return $queryResults;
        }

        $queryResults[] = "Exercise saved";

        return $queryResults;
    }

    public function update($exerciseId, $requestParams)
    {
        $queryResults = [];

        if(empty($this->find($exerciseId))) {
            $queryResults['Error'] = 'Exercise to delete does not exist';
            return $queryResults;
        }

        $query = "UPDATE exercises SET author = ?, text = ? WHERE exercises.id = $exerciseId";

        $stmt = $this->container['db']->prepare($query);

        try {
            $stmt->bind_param("ss", $requestParams['author'], $requestParams['text']);
            $stmt->execute();
        } catch (Throwable $throwable) {
            $queryResults['Error'] = 'Error when querying the database';
            return $queryResults;
        }

        if ($stmt->affected_rows == 0) {
            return $queryResults;
        }

        $queryResults[] = "Exercise with exerciseId = $exerciseId updated";;

        return $queryResults;
    }

    private function runSelectQuery($query)
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