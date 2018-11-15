<?php

declare(strict_types=1);

namespace TiendaNube\Checkout\Service\Store;

use Psr\Log\LoggerInterface;

/**
 * Class StoreService
 *
 * @package TiendaNube\Checkout\Service\Store
 */
class StoreService implements StoreServiceInterface
{
    #TODO class
    /**
     * Get the current store instance
     *
     * @return Store
     */
    public function getCurrentStore():Store;
    
    /**
     * The database connection link
     *
     * @var \PDO
     */
    private $connection;
    
    private $logger;
    
    /**
     * StoreService constructor.
     *
     * @param \PDO $pdo
     * @param LoggerInterface $logger
     */
    public function __construct(\PDO $pdo, LoggerInterface $logger)
    {
        $this->connection = $pdo;
        $this->logger = $logger;
    }
}
