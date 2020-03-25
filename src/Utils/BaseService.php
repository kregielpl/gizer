<?php

namespace App\Utils;

use Doctrine\Bundle\MongoDBBundle\Logger\Logger;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;


class BaseService
{

    /** @var DocumentManager */
    protected $documentManager;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * BaseService constructor.
     * @param DocumentManager $documentManager
     * @param LoggerInterface $logger
     */
    public function __construct(DocumentManager $documentManager, LoggerInterface $logger)
    {
        $this->documentManager  = $documentManager;
        $this->logger           = $logger;
    }

}