<?php

namespace IEXBase\TronAPI;

use IEXBase\TronAPI\Concerns\Manageable;
use IEXBase\TronAPI\Provider\HttpProviderInterface;

class TronScan
{
    use Manageable;

    /**
     * @param  \IEXBase\TronAPI\Provider\HttpProviderInterface|null  $explorer
     *
     * @throws \IEXBase\TronAPI\Exception\TronException
     */
    public function __construct(?HttpProviderInterface $explorer = null)
    {
        $this->setManager(
            new TronManager($this, [
                'explorer' => $explorer,
            ])
        );
    }

    /**
     * @throws \IEXBase\TronAPI\Exception\TronException
     */
    public function latest()
    {
        return $this->manager->request('api/block/latest');
    }
}
