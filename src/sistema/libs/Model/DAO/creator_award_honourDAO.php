<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("creator_award_honourMap.php");

/**
 * creator_award_honourDAO provides object-oriented access to the creator_award_honour table.  This
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
class creator_award_honourDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Description;

	/** @var string */
	public $Grantedby;

	/** @var string */
	public $Title;

	/** @var string */
	public $Type;

	/** @var int */
	public $Creator;


	/**
	 * Returns the foreign object based on the value of Creator
	 * @return Creator
	 */
	public function GetCreator()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_qr69vjpxl6txy39isg3fpmx6q");
	}


}
?>