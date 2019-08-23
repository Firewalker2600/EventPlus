<?php

class Spolecnost extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nazev_spolecnosti;

    /**
     *
     * @var string
     */
    public $adresa;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("spolecnost");
        $this->hasMany('id', 'Kontakt', 'id_spolecnosti', ['alias' => 'Kontakt']);
        $this->hasMany('id', 'Objednavka', 'id_spolecnost', ['alias' => 'Objednavka']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'spolecnost';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spolecnost[]|Spolecnost|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spolecnost|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
