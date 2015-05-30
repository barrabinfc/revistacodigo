<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * autoridadeMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the autoridadeDAO to the authority datastore.
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
class autoridadeMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idauthority"] = new FieldMap("Idauthority","authority","idauthority",true,FM_TYPE_BIGINT,20,null,true);
			self::$FM["Name"] = new FieldMap("Name","authority","name",false,FM_TYPE_VARCHAR,15,null,false);
			self::$FM["Audisplay"] = new FieldMap("Audisplay","authority","audisplay",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Aulist"] = new FieldMap("Aulist","authority","aulist",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Auinsert"] = new FieldMap("Auinsert","authority","auinsert",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Auupdate"] = new FieldMap("Auupdate","authority","auupdate",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Auread"] = new FieldMap("Auread","authority","auread",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Audelete"] = new FieldMap("Audelete","authority","audelete",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Auexecute"] = new FieldMap("Auexecute","authority","auexecute",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Auexport"] = new FieldMap("Auexport","authority","auexport",false,FM_TYPE_UNKNOWN,1,null,false);
			self::$FM["Module"] = new FieldMap("Module","authority","module",false,FM_TYPE_INT,11,null,false);
			self::$FM["Institution"] = new FieldMap("Institution","authority","institution",false,FM_TYPE_INT,11,null,false);
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