<?php


namespace BusuuTest\EntityRepository;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserRepository implements RepositoryInterface
{
    public function find($userId, Response $response)
    {
    }

    public function findAll(Response $response)
    {
    }

    public function save(Request $request, Response $response)
    {
    }

    public function delete($entityId, Response $response)
    {
    }

    public function update(Request $request, Response $response)
    {
    }

    //TODO come back to this when I start to look at ORM
    //public function save($user){}
}