<?php

namespace App\EventListener;

use App\Entity\Step;
use App\Repository\StepRepository;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Step::class)]
class StepPositionListener
{
    public function __construct(
        private StepRepository $stepRepo
    ) {
    }

    public function prePersist(Step $step): void
    {
        $recipe = $step->getRecipe();
        $maxPos = $this->stepRepo->findMaxPositionByRecipe($recipe);
        $step->setPosition($maxPos + 1);
    }
}
