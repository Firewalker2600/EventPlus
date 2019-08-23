<?php

class Objednavka extends \Phalcon\Mvc\Model
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
    public $datum_akce;

    /**
     *
     * @var integer
     */
    public $pocet_osob;

    /**
     *
     * @var string
     */
    public $program_akce;

    /**
     *
     * @var string
     */
    public $misto_akce;

    /**
     *
     * @var integer
     */
    public $id_spolecnost;

    /**
     *
     * @var integer
     */
    public $id_kontakt;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("public");
        $this->setSource("objednavka");
        $this->belongsTo('id_kontakt', 'Kontakt', 'id', ['alias' => 'Kontakt']);
        $this->belongsTo('id_spolecnost', 'Spolecnost', 'id', ['alias' => 'Spolecnost']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'objednavka';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Objednavka[]|Objednavka|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Objednavka|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
