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

    public function save($requestParams);

    public function update($entityId, $requestParams);
}