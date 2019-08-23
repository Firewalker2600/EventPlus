<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\Alpha;

class SpolecnostForm extends Form
{
  public function initialize()
  {
    $spolecnost = new Text('nazev_spolecnosti');
    $spolecnost->setLabel('Společnost');
    $spolecnost->setAttribute('placeholder','Vaše Firma s.r.o.');
    $spolecnost->addValidator(new Alpha(['message'=>'Zadejte platný název společnosti']));
    $this->add($spolecnost);
  }
}
