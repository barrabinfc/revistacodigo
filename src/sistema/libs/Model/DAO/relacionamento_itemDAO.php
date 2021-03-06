<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("relacionamento_itemMap.php");

/**
 * relacionamento_itemDAO provides object-oriented access to the relationship_item table.  This
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
class relacionamento_itemDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Type;

	/** @var int */
	public $Item;

	/** @var int */
	public $Relationship;


	/**
	 * Returns the foreign object based on the value of Item
	 * @return Item
	 */
	public function GetItem()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_c0y3gf5cowm6uo7ecld19tuqa");
	}

	/**
	 * Returns the foreign object based on the value of Relationship
	 * @return Item
	 */
	public function GetRelationshipItem()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_geqqk61hbyqn45ylpg1fwctja");
	}


}
?>