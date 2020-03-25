<?php

namespace App\Repository;

use App\Document\Score;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class ScoreRepository extends DocumentRepository
{
    public function addScore($data)
    {
        try {
            $oldScore = $this->findOneBy(['scoreId' => $data['id']]);

            if(!$oldScore){
                $score = new Score();
                $score->setCreated(new \DateTime());
                $score->setUsername($data['user']['name']);
                $score->setUserId($data['user']['id']);
                $score->setScore($data['score']);
                $score->setScoreId($data['id']);
                $score->setFinished(new \DateTime(date($data['finished_at'])));

                $this->getDocumentManager()->persist($score);
                $this->getDocumentManager()->flush();
            }
        } catch (\Exception $e) {
            throw new \Exception("Error while saving in database: " .  $e->getMessage());
        }
    }

    public function findAllArray($sortCol, $sortDir)
    {
        $query = $this->createQueryBuilder();

        if($sortCol == 'date' && in_array($sortDir, ['asc', 'desc'])){
            $query->sort('finished', $sortDir);
        }else if($sortCol == 'score' && in_array($sortDir, ['asc', 'desc'])){
            $query->sort('score', $sortDir);
        }

        return $query->getQuery()->toArray();
    }
}
