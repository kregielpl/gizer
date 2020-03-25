<?php

namespace App\Utils;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;;

class Utils
{
    /**
     * @param $data
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public static function validateScore($data)
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([
            'id'    => new Assert\Length(['min' => 1, 'max' => 255]),
            'finished_at' => [
//                new Assert\Date(), //todo: fix problem with validation UTC date
                new Assert\NotBlank()
            ],
            'user' => new Assert\Collection([
                'name' => new Assert\Length(['min' => 1, 'max' => 255]),
                'id' => new Assert\Length(['min' => 1, 'max' => 255]),
            ]),
            'score' => [
                new Assert\PositiveOrZero(),
                new Assert\Range([
                    'max' => PHP_INT_MAX
                ])
            ]
        ]);

        return $validator->validate($data, $constraint);
    }
}