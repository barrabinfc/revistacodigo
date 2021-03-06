<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("nivelMap.php");

/**
 * nivelDAO provides object-oriented access to the level table.  This
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
class nivelDAO extends Phreezable
{
	/** @var int */
	public $Idlevel;

	/** @var int */
	public $Seriefather;

	/** @var int */
	public $Fond;

	/** @var int */
	public $Institution;

	/** @var string */
	public $Type;

	/** @var string */
	public $Level;

	/** @var int */
	public $Countitem;


	/**
	 * Returns a dataset of InstitutionLevel objects with matching LevelsIdlevel
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSInstitutionLevels($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_56md01pp54ivtjhs8gg0esb9s", $criteria);
	}

	/**
	 * Returns a dataset of Level objects with matching Seriefather
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSeriefatherLevels($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "fk_series_series", $criteria);
	}

	/**
	 * Returns the foreign object based on the value of Fond
	 * @return Fond
	 */
	public function GetFond()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_serie_fond1");
	}

	/**
	 * Returns the foreign object based on the value of Institution
	 * @return Institution
	 */
	public function GetInstitution()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_serie_institution1");
	}

	/**
	 * Returns the foreign object based on the value of Seriefather
	 * @return Level
	 */
	public function GetSeriefatherLevel()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_series_series");
	}


}
?>