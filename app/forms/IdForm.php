<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;

class IdForm extends Form
{
    public function initialize()
    {
        // Id poptavky
        $id = new Numeric('id');
        $id->setLabel('Id poptávky');
        $id->setFilters('absint');
        $id->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Bez id nic nevygeneruju',
                    ]
                ),
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
