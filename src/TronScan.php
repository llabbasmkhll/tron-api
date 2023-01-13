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
     * @return array
     * @throws \IEXBase\TronAPI\Exception\TronException
     */
    public function latest(): array
    {
        return $this->manager->request('api/block/latest');
    }

    /**
     * @param  string|null  $sort
     * @param  int|null  $limit
     * @param  int|null  $start
     *
     * @return array
     * @throws \IEXBase\TronAPI\Exception\TronException
     */
    public function accounts(?string $sort = null, ?int $limit = null, ?int $start = null): array
    {
        $params = array_filter([
            'sort'  => $sort,
            'limit' => $limit,
            'start' => $start,
        ]);

        return $this->manager->request('api/account/list', $params);
    }

    /**
     * @param  string  $address
     *
     * @return array
     * @throws \IEXBase\TronAPI\Exception\TronException
     */
    public function account(string $address): array
    {
        $params['address'] = $address;

        return $this->manager->request('api/account', $params);
    }
}
