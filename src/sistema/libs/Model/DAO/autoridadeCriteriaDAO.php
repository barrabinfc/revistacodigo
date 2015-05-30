<?php
/** @package    Sistema::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Criteria.php");

/**
 * autoridadeCriteria allows custom querying for the autoridade object.
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
class autoridadeCriteriaDAO extends Criteria
{

	public $Idauthority_Equals;
	public $Idauthority_NotEquals;
	public $Idauthority_IsLike;
	public $Idauthority_IsNotLike;
	public $Idauthority_BeginsWith;
	public $Idauthority_EndsWith;
	public $Idauthority_GreaterThan;
	public $Idauthority_GreaterThanOrEqual;
	public $Idauthority_LessThan;
	public $Idauthority_LessThanOrEqual;
	public $Idauthority_In;
	public $Idauthority_IsNotEmpty;
	public $Idauthority_IsEmpty;
	public $Idauthority_BitwiseOr;
	public $Idauthority_BitwiseAnd;
	public $Name_Equals;
	public $Name_NotEquals;
	public $Name_IsLike;
	public $Name_IsNotLike;
	public $Name_BeginsWith;
	public $Name_EndsWith;
	public $Name_GreaterThan;
	public $Name_GreaterThanOrEqual;
	public $Name_LessThan;
	public $Name_LessThanOrEqual;
	public $Name_In;
	public $Name_IsNotEmpty;
	public $Name_IsEmpty;
	public $Name_BitwiseOr;
	public $Name_BitwiseAnd;
	public $Audisplay_Equals;
	public $Audisplay_NotEquals;
	public $Audisplay_IsLike;
	public $Audisplay_IsNotLike;
	public $Audisplay_BeginsWith;
	public $Audisplay_EndsWith;
	public $Audisplay_GreaterThan;
	public $Audisplay_GreaterThanOrEqual;
	public $Audisplay_LessThan;
	public $Audisplay_LessThanOrEqual;
	public $Audisplay_In;
	public $Audisplay_IsNotEmpty;
	public $Audisplay_IsEmpty;
	public $Audisplay_BitwiseOr;
	public $Audisplay_BitwiseAnd;
	public $Aulist_Equals;
	public $Aulist_NotEquals;
	public $Aulist_IsLike;
	public $Aulist_IsNotLike;
	public $Aulist_BeginsWith;
	public $Aulist_EndsWith;
	public $Aulist_GreaterThan;
	public $Aulist_GreaterThanOrEqual;
	public $Aulist_LessThan;
	public $Aulist_LessThanOrEqual;
	public $Aulist_In;
	public $Aulist_IsNotEmpty;
	public $Aulist_IsEmpty;
	public $Aulist_BitwiseOr;
	public $Aulist_BitwiseAnd;
	public $Auinsert_Equals;
	public $Auinsert_NotEquals;
	public $Auinsert_IsLike;
	public $Auinsert_IsNotLike;
	public $Auinsert_BeginsWith;
	public $Auinsert_EndsWith;
	public $Auinsert_GreaterThan;
	public $Auinsert_GreaterThanOrEqual;
	public $Auinsert_LessThan;
	public $Auinsert_LessThanOrEqual;
	public $Auinsert_In;
	public $Auinsert_IsNotEmpty;
	public $Auinsert_IsEmpty;
	public $Auinsert_BitwiseOr;
	public $Auinsert_BitwiseAnd;
	public $Auupdate_Equals;
	public $Auupdate_NotEquals;
	public $Auupdate_IsLike;
	public $Auupdate_IsNotLike;
	public $Auupdate_BeginsWith;
	public $Auupdate_EndsWith;
	public $Auupdate_GreaterThan;
	public $Auupdate_GreaterThanOrEqual;
	public $Auupdate_LessThan;
	public $Auupdate_LessThanOrEqual;
	public $Auupdate_In;
	public $Auupdate_IsNotEmpty;
	public $Auupdate_IsEmpty;
	public $Auupdate_BitwiseOr;
	public $Auupdate_BitwiseAnd;
	public $Auread_Equals;
	public $Auread_NotEquals;
	public $Auread_IsLike;
	public $Auread_IsNotLike;
	public $Auread_BeginsWith;
	public $Auread_EndsWith;
	public $Auread_GreaterThan;
	public $Auread_GreaterThanOrEqual;
	public $Auread_LessThan;
	public $Auread_LessThanOrEqual;
	public $Auread_In;
	public $Auread_IsNotEmpty;
	public $Auread_IsEmpty;
	public $Auread_BitwiseOr;
	public $Auread_BitwiseAnd;
	public $Audelete_Equals;
	public $Audelete_NotEquals;
	public $Audelete_IsLike;
	public $Audelete_IsNotLike;
	public $Audelete_BeginsWith;
	public $Audelete_EndsWith;
	public $Audelete_GreaterThan;
	public $Audelete_GreaterThanOrEqual;
	public $Audelete_LessThan;
	public $Audelete_LessThanOrEqual;
	public $Audelete_In;
	public $Audelete_IsNotEmpty;
	public $Audelete_IsEmpty;
	public $Audelete_BitwiseOr;
	public $Audelete_BitwiseAnd;
	public $Auexecute_Equals;
	public $Auexecute_NotEquals;
	public $Auexecute_IsLike;
	public $Auexecute_IsNotLike;
	public $Auexecute_BeginsWith;
	public $Auexecute_EndsWith;
	public $Auexecute_GreaterThan;
	public $Auexecute_GreaterThanOrEqual;
	public $Auexecute_LessThan;
	public $Auexecute_LessThanOrEqual;
	public $Auexecute_In;
	public $Auexecute_IsNotEmpty;
	public $Auexecute_IsEmpty;
	public $Auexecute_BitwiseOr;
	public $Auexecute_BitwiseAnd;
	public $Auexport_Equals;
	public $Auexport_NotEquals;
	public $Auexport_IsLike;
	public $Auexport_IsNotLike;
	public $Auexport_BeginsWith;
	public $Auexport_EndsWith;
	public $Auexport_GreaterThan;
	public $Auexport_GreaterThanOrEqual;
	public $Auexport_LessThan;
	public $Auexport_LessThanOrEqual;
	public $Auexport_In;
	public $Auexport_IsNotEmpty;
	public $Auexport_IsEmpty;
	public $Auexport_BitwiseOr;
	public $Auexport_BitwiseAnd;
	public $Module_Equals;
	public $Module_NotEquals;
	public $Module_IsLike;
	public $Module_IsNotLike;
	public $Module_BeginsWith;
	public $Module_EndsWith;
	public $Module_GreaterThan;
	public $Module_GreaterThanOrEqual;
	public $Module_LessThan;
	public $Module_LessThanOrEqual;
	public $Module_In;
	public $Module_IsNotEmpty;
	public $Module_IsEmpty;
	public $Module_BitwiseOr;
	public $Module_BitwiseAnd;
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

}

?>