<?php

namespace SlimPractice\Traits;

trait LoggerAwareTrait
{
    protected $logger;

    /**
     * @return mixed
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param mixed $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function logError($msg, $context = [])
    {
        if(!$this->getLogger()) {
            return;
        }
        $this->getLogger()->addError($msg, $context);

    }
}