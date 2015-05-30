<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * midiaCriteria allows custom querying for the midia object.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the ModelCriteria class which is extended from this class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @inheritdocs
 * @package Sistema::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class midiaCriteriaDAO extends Criteria
{

	public $Idmedia_Equals;
	public $Idmedia_NotEquals;
	public $Idmedia_IsLike;
	public $Idmedia_IsNotLike;
	public $Idmedia_BeginsWith;
	public $Idmedia_EndsWith;
	public $Idmedia_GreaterThan;
	public $Idmedia_GreaterThanOrEqual;
	public $Idmedia_LessThan;
	public $Idmedia_LessThanOrEqual;
	public $Idmedia_In;
	public $Idmedia_IsNotEmpty;
	public $Idmedia_IsEmpty;
	public $Idmedia_BitwiseOr;
	public $Idmedia_BitwiseAnd;
	public $Item_Equals;
	public $Item_NotEquals;
	public $Item_IsLike;
	public $Item_IsNotLike;
	public $Item_BeginsWith;
	public $Item_EndsWith;
	public $Item_GreaterThan;
	public $Item_GreaterThanOrEqual;
	public $Item_LessThan;
	public $Item_LessThanOrEqual;
	public $Item_In;
	public $Item_IsNotEmpty;
	public $Item_IsEmpty;
	public $Item_BitwiseOr;
	public $Item_BitwiseAnd;
	public $Idhistory_Equals;
	public $Idhistory_NotEquals;
	public $Idhistory_IsLike;
	public $Idhistory_IsNotLike;
	public $Idhistory_BeginsWith;
	public $Idhistory_EndsWith;
	public $Idhistory_GreaterThan;
	public $Idhistory_GreaterThanOrEqual;
	public $Idhistory_LessThan;
	public $Idhistory_LessThanOrEqual;
	public $Idhistory_In;
	public $Idhistory_IsNotEmpty;
	public $Idhistory_IsEmpty;
	public $Idhistory_BitwiseOr;
	public $Idhistory_BitwiseAnd;
	public $Storage_Equals;
	public $Storage_NotEquals;
	public $Storage_IsLike;
	public $Storage_IsNotLike;
	public $Storage_BeginsWith;
	public $Storage_EndsWith;
	public $Storage_GreaterThan;
	public $Storage_GreaterThanOrEqual;
	public $Storage_LessThan;
	public $Storage_LessThanOrEqual;
	public $Storage_In;
	public $Storage_IsNotEmpty;
	public $Storage_IsEmpty;
	public $Storage_BitwiseOr;
	public $Storage_BitwiseAnd;
	public $Iddocumentation_Equals;
	public $Iddocumentation_NotEquals;
	public $Iddocumentation_IsLike;
	public $Iddocumentation_IsNotLike;
	public $Iddocumentation_BeginsWith;
	public $Iddocumentation_EndsWith;
	public $Iddocumentation_GreaterThan;
	public $Iddocumentation_GreaterThanOrEqual;
	public $Iddocumentation_LessThan;
	public $Iddocumentation_LessThanOrEqual;
	public $Iddocumentation_In;
	public $Iddocumentation_IsNotEmpty;
	public $Iddocumentation_IsEmpty;
	public $Iddocumentation_BitwiseOr;
	public $Iddocumentation_BitwiseAnd;
	public $Institution_Equals;
	public $Institution_NotEquals;
	public $Institution_IsLike;
	public $Institution_IsNotLike;
	public $Institution_BeginsWith;
	public $Institution_EndsWith;
	public $Institution_GreaterThan;
	public $Institution_GreaterThanOrEqual;
	public $Institution_LessThan;
	public $Institution_LessThanOrEqual;
	public $Institution_In;
	public $Institution_IsNotEmpty;
	public $Institution_IsEmpty;
	public $Institution_BitwiseOr;
	public $Institution_BitwiseAnd;
	public $Idreference_Equals;
	public $Idreference_NotEquals;
	public $Idreference_IsLike;
	public $Idreference_IsNotLike;
	public $Idreference_BeginsWith;
	public $Idreference_EndsWith;
	public $Idreference_GreaterThan;
	public $Idreference_GreaterThanOrEqual;
	public $Idreference_LessThan;
	public $Idreference_LessThanOrEqual;
	public $Idreference_In;
	public $Idreference_IsNotEmpty;
	public $Idreference_IsEmpty;
	public $Idreference_BitwiseOr;
	public $Idreference_BitwiseAnd;
	public $Mediatype_Equals;
	public $Mediatype_NotEquals;
	public $Mediatype_IsLike;
	public $Mediatype_IsNotLike;
	public $Mediatype_BeginsWith;
	public $Mediatype_EndsWith;
	public $Mediatype_GreaterThan;
	public $Mediatype_GreaterThanOrEqual;
	public $Mediatype_LessThan;
	public $Mediatype_LessThanOrEqual;
	public $Mediatype_In;
	public $Mediatype_IsNotEmpty;
	public $Mediatype_IsEmpty;
	public $Mediatype_BitwiseOr;
	public $Mediatype_BitwiseAnd;
	public $Mediaurl_Equals;
	public $Mediaurl_NotEquals;
	public $Mediaurl_IsLike;
	public $Mediaurl_IsNotLike;
	public $Mediaurl_BeginsWith;
	public $Mediaurl_EndsWith;
	public $Mediaurl_GreaterThan;
	public $Mediaurl_GreaterThanOrEqual;
	public $Mediaurl_LessThan;
	public $Mediaurl_LessThanOrEqual;
	public $Mediaurl_In;
	public $Mediaurl_IsNotEmpty;
	public $Mediaurl_IsEmpty;
	public $Mediaurl_BitwiseOr;
	public $Mediaurl_BitwiseAnd;
	public $Digitizationdate_Equals;
	public $Digitizationdate_NotEquals;
	public $Digitizationdate_IsLike;
	public $Digitizationdate_IsNotLike;
	public $Digitizationdate_BeginsWith;
	public $Digitizationdate_EndsWith;
	public $Digitizationdate_GreaterThan;
	public $Digitizationdate_GreaterThanOrEqual;
	public $Digitizationdate_LessThan;
	public $Digitizationdate_LessThanOrEqual;
	public $Digitizationdate_In;
	public $Digitizationdate_IsNotEmpty;
	public $Digitizationdate_IsEmpty;
	public $Digitizationdate_BitwiseOr;
	public $Digitizationdate_BitwiseAnd;
	public $Digitizationresponsable_Equals;
	public $Digitizationresponsable_NotEquals;
	public $Digitizationresponsable_IsLike;
	public $Digitizationresponsable_IsNotLike;
	public $Digitizationresponsable_BeginsWith;
	public $Digitizationresponsable_EndsWith;
	public $Digitizationresponsable_GreaterThan;
	public $Digitizationresponsable_GreaterThanOrEqual;
	public $Digitizationresponsable_LessThan;
	public $Digitizationresponsable_LessThanOrEqual;
	public $Digitizationresponsable_In;
	public $Digitizationresponsable_IsNotEmpty;
	public $Digitizationresponsable_IsEmpty;
	public $Digitizationresponsable_BitwiseOr;
	public $Digitizationresponsable_BitwiseAnd;
	public $Polarity_Equals;
	public $Polarity_NotEquals;
	public $Polarity_IsLike;
	public $Polarity_IsNotLike;
	public $Polarity_BeginsWith;
	public $Polarity_EndsWith;
	public $Polarity_GreaterThan;
	public $Polarity_GreaterThanOrEqual;
	public $Polarity_LessThan;
	public $Polarity_LessThanOrEqual;
	public $Polarity_In;
	public $Polarity_IsNotEmpty;
	public $Polarity_IsEmpty;
	public $Polarity_BitwiseOr;
	public $Polarity_BitwiseAnd;
	public $Colorspace_Equals;
	public $Colorspace_NotEquals;
	public $Colorspace_IsLike;
	public $Colorspace_IsNotLike;
	public $Colorspace_BeginsWith;
	public $Colorspace_EndsWith;
	public $Colorspace_GreaterThan;
	public $Colorspace_GreaterThanOrEqual;
	public $Colorspace_LessThan;
	public $Colorspace_LessThanOrEqual;
	public $Colorspace_In;
	public $Colorspace_IsNotEmpty;
	public $Colorspace_IsEmpty;
	public $Colorspace_BitwiseOr;
	public $Colorspace_BitwiseAnd;
	public $Iccprofile_Equals;
	public $Iccprofile_NotEquals;
	public $Iccprofile_IsLike;
	public $Iccprofile_IsNotLike;
	public $Iccprofile_BeginsWith;
	public $Iccprofile_EndsWith;
	public $Iccprofile_GreaterThan;
	public $Iccprofile_GreaterThanOrEqual;
	public $Iccprofile_LessThan;
	public $Iccprofile_LessThanOrEqual;
	public $Iccprofile_In;
	public $Iccprofile_IsNotEmpty;
	public $Iccprofile_IsEmpty;
	public $Iccprofile_BitwiseOr;
	public $Iccprofile_BitwiseAnd;
	public $Xresolution_Equals;
	public $Xresolution_NotEquals;
	public $Xresolution_IsLike;
	public $Xresolution_IsNotLike;
	public $Xresolution_BeginsWith;
	public $Xresolution_EndsWith;
	public $Xresolution_GreaterThan;
	public $Xresolution_GreaterThanOrEqual;
	public $Xresolution_LessThan;
	public $Xresolution_LessThanOrEqual;
	public $Xresolution_In;
	public $Xresolution_IsNotEmpty;
	public $Xresolution_IsEmpty;
	public $Xresolution_BitwiseOr;
	public $Xresolution_BitwiseAnd;
	public $Yresolution_Equals;
	public $Yresolution_NotEquals;
	public $Yresolution_IsLike;
	public $Yresolution_IsNotLike;
	public $Yresolution_BeginsWith;
	public $Yresolution_EndsWith;
	public $Yresolution_GreaterThan;
	public $Yresolution_GreaterThanOrEqual;
	public $Yresolution_LessThan;
	public $Yresolution_LessThanOrEqual;
	public $Yresolution_In;
	public $Yresolution_IsNotEmpty;
	public $Yresolution_IsEmpty;
	public $Yresolution_BitwiseOr;
	public $Yresolution_BitwiseAnd;
	public $Thumbnail_Equals;
	public $Thumbnail_NotEquals;
	public $Thumbnail_IsLike;
	public $Thumbnail_IsNotLike;
	public $Thumbnail_BeginsWith;
	public $Thumbnail_EndsWith;
	public $Thumbnail_GreaterThan;
	public $Thumbnail_GreaterThanOrEqual;
	public $Thumbnail_LessThan;
	public $Thumbnail_LessThanOrEqual;
	public $Thumbnail_In;
	public $Thumbnail_IsNotEmpty;
	public $Thumbnail_IsEmpty;
	public $Thumbnail_BitwiseOr;
	public $Thumbnail_BitwiseAnd;
	public $Digitizationequipment_Equals;
	public $Digitizationequipment_NotEquals;
	public $Digitizationequipment_IsLike;
	public $Digitizationequipment_IsNotLike;
	public $Digitizationequipment_BeginsWith;
	public $Digitizationequipment_EndsWith;
	public $Digitizationequipment_GreaterThan;
	public $Digitizationequipment_GreaterThanOrEqual;
	public $Digitizationequipment_LessThan;
	public $Digitizationequipment_LessThanOrEqual;
	public $Digitizationequipment_In;
	public $Digitizationequipment_IsNotEmpty;
	public $Digitizationequipment_IsEmpty;
	public $Digitizationequipment_BitwiseOr;
	public $Digitizationequipment_BitwiseAnd;
	public $Format_Equals;
	public $Format_NotEquals;
	public $Format_IsLike;
	public $Format_IsNotLike;
	public $Format_BeginsWith;
	public $Format_EndsWith;
	public $Format_GreaterThan;
	public $Format_GreaterThanOrEqual;
	public $Format_LessThan;
	public $Format_LessThanOrEqual;
	public $Format_In;
	public $Format_IsNotEmpty;
	public $Format_IsEmpty;
	public $Format_BitwiseOr;
	public $Format_BitwiseAnd;
	public $Ispublic_Equals;
	public $Ispublic_NotEquals;
	public $Ispublic_IsLike;
	public $Ispublic_IsNotLike;
	public $Ispublic_BeginsWith;
	public $Ispublic_EndsWith;
	public $Ispublic_GreaterThan;
	public $Ispublic_GreaterThanOrEqual;
	public $Ispublic_LessThan;
	public $Ispublic_LessThanOrEqual;
	public $Ispublic_In;
	public $Ispublic_IsNotEmpty;
	public $Ispublic_IsEmpty;
	public $Ispublic_BitwiseOr;
	public $Ispublic_BitwiseAnd;
	public $Ordername_Equals;
	public $Ordername_NotEquals;
	public $Ordername_IsLike;
	public $Ordername_IsNotLike;
	public $Ordername_BeginsWith;
	public $Ordername_EndsWith;
	public $Ordername_GreaterThan;
	public $Ordername_GreaterThanOrEqual;
	public $Ordername_LessThan;
	public $Ordername_LessThanOrEqual;
	public $Ordername_In;
	public $Ordername_IsNotEmpty;
	public $Ordername_IsEmpty;
	public $Ordername_BitwiseOr;
	public $Ordername_BitwiseAnd;
	public $Sent_Equals;
	public $Sent_NotEquals;
	public $Sent_IsLike;
	public $Sent_IsNotLike;
	public $Sent_BeginsWith;
	public $Sent_EndsWith;
	public $Sent_GreaterThan;
	public $Sent_GreaterThanOrEqual;
	public $Sent_LessThan;
	public $Sent_LessThanOrEqual;
	public $Sent_In;
	public $Sent_IsNotEmpty;
	public $Sent_IsEmpty;
	public $Sent_BitwiseOr;
	public $Sent_BitwiseAnd;
	public $Exif_Equals;
	public $Exif_NotEquals;
	public $Exif_IsLike;
	public $Exif_IsNotLike;
	public $Exif_BeginsWith;
	public $Exif_EndsWith;
	public $Exif_GreaterThan;
	public $Exif_GreaterThanOrEqual;
	public $Exif_LessThan;
	public $Exif_LessThanOrEqual;
	public $Exif_In;
	public $Exif_IsNotEmpty;
	public $Exif_IsEmpty;
	public $Exif_BitwiseOr;
	public $Exif_BitwiseAnd;
	public $Textual_Equals;
	public $Textual_NotEquals;
	public $Textual_IsLike;
	public $Textual_IsNotLike;
	public $Textual_BeginsWith;
	public $Textual_EndsWith;
	public $Textual_GreaterThan;
	public $Textual_GreaterThanOrEqual;
	public $Textual_LessThan;
	public $Textual_LessThanOrEqual;
	public $Textual_In;
	public $Textual_IsNotEmpty;
	public $Textual_IsEmpty;
	public $Textual_BitwiseOr;
	public $Textual_BitwiseAnd;
	public $Sizemedia_Equals;
	public $Sizemedia_NotEquals;
	public $Sizemedia_IsLike;
	public $Sizemedia_IsNotLike;
	public $Sizemedia_BeginsWith;
	public $Sizemedia_EndsWith;
	public $Sizemedia_GreaterThan;
	public $Sizemedia_GreaterThanOrEqual;
	public $Sizemedia_LessThan;
	public $Sizemedia_LessThanOrEqual;
	public $Sizemedia_In;
	public $Sizemedia_IsNotEmpty;
	public $Sizemedia_IsEmpty;
	public $Sizemedia_BitwiseOr;
	public $Sizemedia_BitwiseAnd;
	public $Nameoriginal_Equals;
	public $Nameoriginal_NotEquals;
	public $Nameoriginal_IsLike;
	public $Nameoriginal_IsNotLike;
	public $Nameoriginal_BeginsWith;
	public $Nameoriginal_EndsWith;
	public $Nameoriginal_GreaterThan;
	public $Nameoriginal_GreaterThanOrEqual;
	public $Nameoriginal_LessThan;
	public $Nameoriginal_LessThanOrEqual;
	public $Nameoriginal_In;
	public $Nameoriginal_IsNotEmpty;
	public $Nameoriginal_IsEmpty;
	public $Nameoriginal_BitwiseOr;
	public $Nameoriginal_BitwiseAnd;
	public $Mainmedia_Equals;
	public $Mainmedia_NotEquals;
	public $Mainmedia_IsLike;
	public $Mainmedia_IsNotLike;
	public $Mainmedia_BeginsWith;
	public $Mainmedia_EndsWith;
	public $Mainmedia_GreaterThan;
	public $Mainmedia_GreaterThanOrEqual;
	public $Mainmedia_LessThan;
	public $Mainmedia_LessThanOrEqual;
	public $Mainmedia_In;
	public $Mainmedia_IsNotEmpty;
	public $Mainmedia_IsEmpty;
	public $Mainmedia_BitwiseOr;
	public $Mainmedia_BitwiseAnd;
	public $Mediadir_Equals;
	public $Mediadir_NotEquals;
	public $Mediadir_IsLike;
	public $Mediadir_IsNotLike;
	public $Mediadir_BeginsWith;
	public $Mediadir_EndsWith;
	public $Mediadir_GreaterThan;
	public $Mediadir_GreaterThanOrEqual;
	public $Mediadir_LessThan;
	public $Mediadir_LessThanOrEqual;
	public $Mediadir_In;
	public $Mediadir_IsNotEmpty;
	public $Mediadir_IsEmpty;
	public $Mediadir_BitwiseOr;
	public $Mediadir_BitwiseAnd;
	public $Thumbnaildir_Equals;
	public $Thumbnaildir_NotEquals;
	public $Thumbnaildir_IsLike;
	public $Thumbnaildir_IsNotLike;
	public $Thumbnaildir_BeginsWith;
	public $Thumbnaildir_EndsWith;
	public $Thumbnaildir_GreaterThan;
	public $Thumbnaildir_GreaterThanOrEqual;
	public $Thumbnaildir_LessThan;
	public $Thumbnaildir_LessThanOrEqual;
	public $Thumbnaildir_In;
	public $Thumbnaildir_IsNotEmpty;
	public $Thumbnaildir_IsEmpty;
	public $Thumbnaildir_BitwiseOr;
	public $Thumbnaildir_BitwiseAnd;
	public $Thumbnailurl_Equals;
	public $Thumbnailurl_NotEquals;
	public $Thumbnailurl_IsLike;
	public $Thumbnailurl_IsNotLike;
	public $Thumbnailurl_BeginsWith;
	public $Thumbnailurl_EndsWith;
	public $Thumbnailurl_GreaterThan;
	public $Thumbnailurl_GreaterThanOrEqual;
	public $Thumbnailurl_LessThan;
	public $Thumbnailurl_LessThanOrEqual;
	public $Thumbnailurl_In;
	public $Thumbnailurl_IsNotEmpty;
	public $Thumbnailurl_IsEmpty;
	public $Thumbnailurl_BitwiseOr;
	public $Thumbnailurl_BitwiseAnd;

}

?>