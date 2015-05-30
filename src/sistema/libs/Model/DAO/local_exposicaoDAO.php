<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("local_exposicaoMap.php");

/**
 * local_exposicaoDAO provides object-oriented access to the exposition_placelocation table.  This
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
class local_exposicaoDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Type;

	/** @var int */
	public $Contact;

	/** @var int */
	public $Placelocation;

	/** @var int */
	public $Exposition;



}
?>