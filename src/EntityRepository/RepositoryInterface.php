<?php

namespace SlimPractice\EntityRepository;

interface RepositoryInterface
{
    public function find($entityId);

    public function findAll();

    public function delete($entityId);

    public function save($requestParams);

    public function update($entityId, $requestParams);
}