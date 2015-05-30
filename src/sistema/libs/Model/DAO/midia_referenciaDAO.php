<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("midia_referenciaMap.php");

/**
 * midia_referenciaDAO provides object-oriented access to the reference_media table.  This
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
class midia_referenciaDAO extends Phreezable
{
	/** @var int */
	public $ReferenceIdreference;

	/** @var int */
	public $MediasIdmedia;


	/**
	 * Returns the foreign object based on the value of MediasIdmedia
	 * @return Media
	 */
	public function GetSMedia()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_1i4ds2wp2qiswb43dcjl1tfy6");
	}


}
?>