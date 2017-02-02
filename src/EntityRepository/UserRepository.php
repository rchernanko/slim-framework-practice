<?php


namespace BusuuTest\EntityRepository;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserRepository implements RepositoryInterface
{
    public function find($userId)
    {
    }

    public function findAll()
    {
    }

    public function save(Request $request)
    {
    }

    public function delete($entityId)
    {
    }

    public function update($entityId, Request $request)
    {
    }




    //TODO come back to this when I start to look at ORM
    //public function save($user){}
}