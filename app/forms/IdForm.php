<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class IdForm extends MyForm
{
    public function initialize()
    {
        // Id poptavky
        $id = new Numeric('id',
          [
            'min' => 1,
            'placeholder' => 'Zadejte ID'
          ]
        );
        $id->setLabel('Id poptávky');
        $id->setFilters('absint');
        $id->addValidators(
            [
             new Numericality(
                [
                  'message' => 'Zadejte platné ID',
                ]
              )
            ]
        );
        $this->add($id);

    }
}
