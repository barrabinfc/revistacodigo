<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * local_exposicaoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the local_exposicaoDAO to the exposition_placelocation datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class local_exposicaoMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","exposition_placelocation","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Type"] = new FieldMap("Type","exposition_placelocation","type",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Contact"] = new FieldMap("Contact","exposition_placelocation","contact",false,FM_TYPE_INT,11,null,false);
			self::$FM["Placelocation"] = new FieldMap("Placelocation","exposition_placelocation","placelocation",false,FM_TYPE_BIGINT,20,null,false);
			self::$FM["Exposition"] = new FieldMap("Exposition","exposition_placelocation","exposition",false,FM_TYPE_INT,11,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>