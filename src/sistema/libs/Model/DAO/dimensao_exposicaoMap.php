<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * dimensao_exposicaoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the dimensao_exposicaoDAO to the exposition_dimension datastore.
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
class dimensao_exposicaoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","exposition_dimension","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Type"] = new FieldMap("Type","exposition_dimension","type",false,FM_TYPE_VARCHAR,100,null,false);
			self::$FM["Dimension"] = new FieldMap("Dimension","exposition_dimension","dimension",false,FM_TYPE_INT,11,null,false);
			self::$FM["Exposition"] = new FieldMap("Exposition","exposition_dimension","exposition",false,FM_TYPE_INT,11,null,false);
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
			self::$KM["FK_69we0kulo49s1sr97htshsxtw"] = new KeyMap("FK_69we0kulo49s1sr97htshsxtw", "Dimension", "Dimension", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["FK_ai09pidrxa780uxmakwlex92c"] = new KeyMap("FK_ai09pidrxa780uxmakwlex92c", "Exposition", "Exposition", "Idexposition", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>