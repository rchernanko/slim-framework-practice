<?php
namespace BusuuTest\EntityRepository;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

interface RepositoryInterface
{
    /**
     * Return an entity object or null if the id does not exist //TODO make my all of below responses a lot more robust...
     *
     * @param $entityId
     * @param Response $response
     * @return
     */
    public function find($entityId, Response $response);

    /**
     * Return all entity objects or null if none exist
     *
     * @param Response $response
     * @return
     */
    public function findAll(Response $response);

    /**
     * Delete a specific entity object
     * @param $entityId
     * @param Response $response
     * @return
     */
    public function delete($entityId, Response $response);

    public function save(Request $request, Response $response);

    public function update(Request $request, Response $response);

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