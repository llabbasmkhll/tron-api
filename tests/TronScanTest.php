<?php
namespace IEXBase\TronAPI\Tests;
use IEXBase\TronAPI\Provider\HttpProviderInterface;
use IEXBase\TronAPI\TronScan;
use PHPUnit\Framework\TestCase;

class TronScanTest extends TestCase
{
    private TronScan $tronScan;
    private HttpProviderInterface $httpProvider;

    public function setUp(): void
    {
        $this->httpProvider = $this->createMock(HttpProviderInterface::class);
        $this->tronScan = new TronScan($this->httpProvider);
    }

    public function testLatestBlock()
    {
        $this->httpProvider->method('request')->with('api/block/latest')->willReturn([
            'block_id' => 'some_block_id'
        ]);

        $block = $this->tronScan->latest();
        $this->assertArrayHasKey('block_id', $block);
    }

    public function testAccounts()
    {
        $this->httpProvider->method('request')->with('api/account/list')->willReturn([
            'total' => 10,
            'data' => []
        ]);

        $accounts = $this->tronScan->accounts();
        $this->assertArrayHasKey('total', $accounts);
        $this->assertArrayHasKey('data', $accounts);
    }

    public function testAccount()
    {
        $this->httpProvider->method('request')->with('api/account', ['address' => 'TKrqV7zqWg8T7V5s1sQKxvx9WJX9Ppqr3j'])->willReturn([
            'address' => 'TKrqV7zqWg8T7V5s1sQKxvx9WJX9Ppqr3j',
            'balance' => 0
        ]);

        $account = $this->tronScan->account('TKrqV7zqWg8T7V5s1sQKxvx9WJX9Ppqr3j');
        $this->assertArrayHasKey('address', $account);
        $this->assertArrayHasKey('balance', $account);
    }
}
