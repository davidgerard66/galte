<?php
namespace Pages\PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Pages\PagesBundle\Services\CurlUrl;


class constraintsCheckUrlValidator extends ConstraintValidator
{
        private $curl;

        public function __construct(CurlUrl $curl)
        {
            $this->curl = $curl; //todo comprendre pourquoi c mieux unservice que de faire un new de la classe au besoin
        }

        public function validate($value, Constraint $constraint) //cette function est obligatoire
        {
            //die($constraint->test); // exemple recup de param dans les annot de l'entité

            // la value va etre la valeur passe dans la textarea
            if ($this->curl->findUrl($value))
                    $this->context->addViolation($constraint->message);


        }



}