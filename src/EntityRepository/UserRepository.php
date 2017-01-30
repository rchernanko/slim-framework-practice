<?php


namespace BusuuTest\EntityRepository;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserRepository implements RepositoryInterface
{
    public function find($userId, Response $response, Container $container)
    {
    }

    public function findAll(Response $response, Container $container)
    {
    }

    public function save(Request $request, Response $response, Container $container)
    {
    }

    public function delete($entityId, Response $response, Container $container)
    {
    }

    public function update(Request $request, Response $response, Container $container)
    {
    }

    //TODO come back to this when I start to look at ORM
    //public function save($user){}
}