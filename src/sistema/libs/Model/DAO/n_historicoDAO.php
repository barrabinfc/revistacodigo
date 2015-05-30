<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("n_historicoMap.php");

/**
 * n_historicoDAO provides object-oriented access to the nhistory table.  This
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
class n_historicoDAO extends Phreezable
{
	/** @var int */
	public $Idhistory;

	/** @var string */
	public $Actor;

	/** @var float */
	public $Cost;

	/** @var string */
	public $Date;

	/** @var string */
	public $Description;

	/** @var bit */
	public $Ispublic;

	/** @var int */
	public $Institution;


	/**
	 * Returns a dataset of ExpositionHistory objects with matching History
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetHistoryExpositionHistorys($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_sfxtpv6nypctjcamcjgov1etg", $criteria);
	}


}
?>