<?php
/** @package Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("midiaMap.php");

/**
 * midiaDAO provides object-oriented access to the media table.  This
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
class midiaDAO extends Phreezable
{
	/** @var int */
	public $Idmedia;

	/** @var int */
	public $Item;

	/** @var int */
	public $Idhistory;

	/** @var int */
	public $Storage;

	/** @var int */
	public $Iddocumentation;

	/** @var int */
	public $Institution;

	/** @var int */
	public $Idreference;

	/** @var string */
	public $Mediatype;

	/** @var string */
	public $Mediaurl;

	/** @var date */
	public $Digitizationdate;

	/** @var string */
	public $Digitizationresponsable;

	/** @var string */
	public $Polarity;

	/** @var string */
	public $Colorspace;

	/** @var string */
	public $Iccprofile;

	/** @var string */
	public $Xresolution;

	/** @var string */
	public $Yresolution;

	/** @var blob */
	public $Thumbnail;

	/** @var string */
	public $Digitizationequipment;

	/** @var string */
	public $Format;

	/** @var string */
	public $Ispublic;

	/** @var string */
	public $Ordername;

	/** @var bit */
	public $Sent;

	/** @var string */
	public $Exif;

	/** @var longtext */
	public $Textual;

	/** @var int */
	public $Sizemedia;

	/** @var string */
	public $Nameoriginal;

	/** @var string */
	public $Mainmedia;

	/** @var string */
	public $Mediadir;

	/** @var string */
	public $Thumbnaildir;

	/** @var string */
	public $Thumbnailurl;


	/**
	 * Returns a dataset of DocumentationMedia objects with matching MediasIdmedia
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSDocumentationMedias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_6e9vbhu4tcokto4knwv1qf4ah", $criteria);
	}

	/**
	 * Returns a dataset of InstitutionMedia objects with matching MediasIdmedia
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSInstitutionMedias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_3lwqddobdgdre6fm972g8f6ul", $criteria);
	}

	/**
	 * Returns a dataset of ItemMedia objects with matching MediasIdmedia
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSItemMedias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_sey6rhf0ydi6904yk08gu42d9", $criteria);
	}

	/**
	 * Returns a dataset of ReferenceMedia objects with matching MediasIdmedia
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSReferenceMedias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_1i4ds2wp2qiswb43dcjl1tfy6", $criteria);
	}

	/**
	 * Returns a dataset of StorageMedia objects with matching MediasIdmedia
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetSStorageMedias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_nmymba781jas5ih7fojmm9435", $criteria);
	}

	/**
	 * Returns the foreign object based on the value of Institution
	 * @return Institution
	 */
	public function GetInstitution()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_media_institution1");
	}

	/**
	 * Returns the foreign object based on the value of Item
	 * @return Item
	 */
	public function GetItem()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_media_item1");
	}

	/**
	 * Returns the foreign object based on the value of Storage
	 * @return Storage
	 */
	public function GetStorage()
	{
		return $this->_phreezer->GetManyToOne($this, "fk_media_storage1");
	}


}
?>