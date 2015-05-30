<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * nivelMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the nivelDAO to the level datastore.
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
class nivelMap implements IDaoMap, IDaoMap2
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
			self::$FM["Idlevel"] = new FieldMap("Idlevel","level","idlevel",true,FM_TYPE_INT,11,null,true);
			self::$FM["Seriefather"] = new FieldMap("Seriefather","level","seriefather",false,FM_TYPE_INT,11,null,false);
			self::$FM["Fond"] = new FieldMap("Fond","level","fond",false,FM_TYPE_INT,11,null,false);
			self::$FM["Institution"] = new FieldMap("Institution","level","institution",false,FM_TYPE_INT,11,null,false);
			self::$FM["Type"] = new FieldMap("Type","level","type",false,FM_TYPE_VARCHAR,32,null,false);
			self::$FM["Level"] = new FieldMap("Level","level","level",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Countitem"] = new FieldMap("Countitem","level","countitem",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["FK_56md01pp54ivtjhs8gg0esb9s"] = new KeyMap("FK_56md01pp54ivtjhs8gg0esb9s", "Idlevel", "InstitutionLevel", "LevelsIdlevel", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_series_series"] = new KeyMap("fk_series_series", "Idlevel", "Level", "Seriefather", KM_TYPE_ONETOMANY, KM_LOAD_LAZY);  // use KM_LOAD_EAGER with caution here (one-to-one relationships only)
			self::$KM["fk_serie_fond1"] = new KeyMap("fk_serie_fond1", "Fond", "Fond", "Idfond", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_serie_institution1"] = new KeyMap("fk_serie_institution1", "Institution", "Institution", "Idinstitution", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["fk_series_series"] = new KeyMap("fk_series_series", "Seriefather", "Level", "Idlevel", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>