<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("descricao_itemMap.php");

/**
 * descricao_itemDAO provides object-oriented access to the iteminscription table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class descricao_itemDAO extends Phreezable
{
	/** @var int */
	public $D;

	/** @var int */
	public $Tem;

	/** @var string */
	public $Nscriptiontype;

	/** @var string */
	public $Nscriptiondescription;

	/** @var string */
	public $Nscriptionlocation;


	/**
	 * Returns the foreign object based on the value of Tem
	 * @return Item
	 */
	public function GetTemItem()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_item_inscription");
	}


}
?>