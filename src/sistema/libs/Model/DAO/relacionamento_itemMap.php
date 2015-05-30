<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * relacionamento_itemMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the relacionamento_itemDAO to the relationship_item datastore.
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
class relacionamento_itemMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","relationship_item","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Type"] = new FieldMap("Type","relationship_item","type",false,FM_TYPE_VARCHAR,45,null,false);
			self::$FM["Item"] = new FieldMap("Item","relationship_item","item",false,FM_TYPE_BIGINT,20,null,false);
			self::$FM["Relationship"] = new FieldMap("Relationship","relationship_item","relationship",false,FM_TYPE_BIGINT,20,null,false);
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
			self::$KM["FK_c0y3gf5cowm6uo7ecld19tuqa"] = new KeyMap("FK_c0y3gf5cowm6uo7ecld19tuqa", "Item", "Item", "Iditem", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
			self::$KM["FK_geqqk61hbyqn45ylpg1fwctja"] = new KeyMap("FK_geqqk61hbyqn45ylpg1fwctja", "Relationship", "Item", "Iditem", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>