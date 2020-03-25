<?php

namespace App\Controller;

use App\Document\Score;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    /**
     * @Route("/score/{sortCol}/{sortDir}", name="score")
     */
    public function index(DocumentManager $documentManager, $sortDir = null, $sortCol = null)
    {
        $scores = $documentManager->getRepository(Score::class)->findAllArray($sortCol, $sortDir);
        $list   = [];

        /** @var Score $s */
        foreach ($scores as $s){
            $user['username']   = $s->getUsername();
            $user['score']      = $s->getScore();
            $user['finished']   = $s->getFinished();
            $list[]             = $user;
        }

        return $this->json($list);
    }
}
