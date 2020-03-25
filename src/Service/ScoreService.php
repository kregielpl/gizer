<?php

namespace App\Service;

use App\Document\Score;
use App\Utils\BaseService;
use App\Utils\Utils;
use Doctrine\Bundle\MongoDBBundle\Logger\Logger;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Mime\MimeTypes;


class ScoreService extends BaseService
{

    const SCORE_API_URL = 'https://private-b5236a-jacek10.apiary-mock.com/results/games/1';

    /**
     * ScoreService constructor.
     * @param DocumentManager $documentManager
     * @param LoggerInterface $logger
     */
    public function __construct(DocumentManager $documentManager, LoggerInterface $logger)
    {
        parent::__construct($documentManager, $logger);
    }

    public function importScores()
    {
        $client         = HttpClient::create();
        $response       = $client->request('GET', self::SCORE_API_URL);
        $statusCode     = $response->getStatusCode();
        $contentType    = $response->getHeaders()['content-type'][0];

        if ($statusCode !== 200) {
            $this -> logger -> info("importScores statusCode: " .  $statusCode);
            throw new \Exception('Problem while connecting with API statusCode: ' .  $statusCode);
        } else if ($contentType !== 'application/json') {
            $this -> logger -> info("importScores contentType: " .  $contentType);
            throw new \Exception('Wrong response format contentType: ' . $contentType);
        }else{
            $scoreList = json_decode($response->getContent(),true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this -> logger -> info("Invalid json content: " .  $response->getContent());
                throw new \Exception("Invalid json content: " .  $response->getContent());
            }

            foreach ($scoreList as $sl){
                $errors = Utils::validateScore($sl);

                if (count($errors) > 0) {
                    $errorsString = (string) $errors;

                    throw new \Exception("Invalid data: " .  $errorsString);
                }else{
                    $this->documentManager->getRepository(Score::class)->addScore($sl);
                }
            }
        }

        return true;
    }
}