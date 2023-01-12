<?php

namespace IEXBase\TronAPI\Concerns;

use IEXBase\TronAPI\TronManager;

trait Manageable
{
    /**
     * Provider manager
     *
     * @var TronManager
     */
    protected TronManager $manager;

    /**
     * Get provider manager
     *
     * @return TronManager
     */
    public function getManager(): TronManager
    {
        return $this->manager;
    }

    /**
     * Enter the link to the manager nodes
     *
     * @param $providers
     */
    public function setManager($providers)
    {
        $this->manager = $providers;
    }
}
