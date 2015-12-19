<?php

namespace Pages\PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 *
 * @Annotations
 */
class constraintsCheckUrl extends Constraint
{

public $message = 'le champ contient des liens nons valides';

public $test; // exemple passage de parametre par annoation dans @customassert de l'entite page * @CustomAssert\constraintsCheckUrl(test="lalali")


    public function validatedBy()
    {

        return 'validatorCheckUrl';  // ceci est le nom de la class services dans services/curlurl
    }
}