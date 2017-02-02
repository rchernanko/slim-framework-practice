<?php
namespace BusuuTest\EntityRepository;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

interface RepositoryInterface
{
    public function find($entityId);

    public function findAll();

    public function delete($entityId);

    public function save(Request $request);

    public function update($entityId, Request $request);






    /**
     * Save entity to database
     *
     * @param $entityObject
     * @return mixed
     */
    //public function save($entityObject);
    //TODO come back to this when I start to look at ORM. This way should replace all of the above routes.
    //TODO i.e. i should be updating, deleting, creating via Entities, not via direct SQL commands to the database
}