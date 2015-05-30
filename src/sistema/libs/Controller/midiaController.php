<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/midia.php");

/**
 * midiaController is the controller class for the midia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class midiaController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of midia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for midia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new midiaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idmedia,Item,Idhistory,Storage,Iddocumentation,Institution,Idreference,Mediatype,Mediaurl,Digitizationdate,Digitizationresponsable,Polarity,Colorspace,Iccprofile,Xresolution,Yresolution,Thumbnail,Digitizationequipment,Format,Ispublic,Ordername,Sent,Exif,Textual,Sizemedia,Nameoriginal,Mainmedia,Mediadir,Thumbnaildir,Thumbnailurl'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$midias = $this->Phreezer->Query('midia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $midias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $midias->TotalResults;
				$output->totalPages = $midias->TotalPages;
				$output->pageSize = $midias->PageSize;
				$output->currentPage = $midias->CurrentPage;
			}
			else
			{
				// return all results
				$midias = $this->Phreezer->Query('midia',$criteria);
				$output->rows = $midias->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single midia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idmedia');
			$midia = $this->Phreezer->Get('midia',$pk);
			$this->RenderJSON($midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new midia record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$midia = new midia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $midia->Idmedia = $this->SafeGetVal($json, 'idmedia');

			$midia->Item = $this->SafeGetVal($json, 'item');
			$midia->Idhistory = $this->SafeGetVal($json, 'idhistory');
			$midia->Storage = $this->SafeGetVal($json, 'storage');
			$midia->Iddocumentation = $this->SafeGetVal($json, 'iddocumentation');
			$midia->Institution = $this->SafeGetVal($json, 'institution');
			$midia->Idreference = $this->SafeGetVal($json, 'idreference');
			$midia->Mediatype = $this->SafeGetVal($json, 'mediatype');
			$midia->Mediaurl = $this->SafeGetVal($json, 'mediaurl');
			$midia->Digitizationdate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'digitizationdate')));
			$midia->Digitizationresponsable = $this->SafeGetVal($json, 'digitizationresponsable');
			$midia->Polarity = $this->SafeGetVal($json, 'polarity');
			$midia->Colorspace = $this->SafeGetVal($json, 'colorspace');
			$midia->Iccprofile = $this->SafeGetVal($json, 'iccprofile');
			$midia->Xresolution = $this->SafeGetVal($json, 'xresolution');
			$midia->Yresolution = $this->SafeGetVal($json, 'yresolution');
			$midia->Thumbnail = $this->SafeGetVal($json, 'thumbnail');
			$midia->Digitizationequipment = $this->SafeGetVal($json, 'digitizationequipment');
			$midia->Format = $this->SafeGetVal($json, 'format');
			$midia->Ispublic = $this->SafeGetVal($json, 'ispublic');
			$midia->Ordername = $this->SafeGetVal($json, 'ordername');
			$midia->Sent = $this->SafeGetVal($json, 'sent');
			$midia->Exif = $this->SafeGetVal($json, 'exif');
			$midia->Textual = $this->SafeGetVal($json, 'textual');
			$midia->Sizemedia = $this->SafeGetVal($json, 'sizemedia');
			$midia->Nameoriginal = $this->SafeGetVal($json, 'nameoriginal');
			$midia->Mainmedia = $this->SafeGetVal($json, 'mainmedia');
			$midia->Mediadir = $this->SafeGetVal($json, 'mediadir');
			$midia->Thumbnaildir = $this->SafeGetVal($json, 'thumbnaildir');
			$midia->Thumbnailurl = $this->SafeGetVal($json, 'thumbnailurl');

			$midia->Validate();
			$errors = $midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$midia->Save();
				$this->RenderJSON($midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing midia record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('idmedia');
			$midia = $this->Phreezer->Get('midia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $midia->Idmedia = $this->SafeGetVal($json, 'idmedia', $midia->Idmedia);

			$midia->Item = $this->SafeGetVal($json, 'item', $midia->Item);
			$midia->Idhistory = $this->SafeGetVal($json, 'idhistory', $midia->Idhistory);
			$midia->Storage = $this->SafeGetVal($json, 'storage', $midia->Storage);
			$midia->Iddocumentation = $this->SafeGetVal($json, 'iddocumentation', $midia->Iddocumentation);
			$midia->Institution = $this->SafeGetVal($json, 'institution', $midia->Institution);
			$midia->Idreference = $this->SafeGetVal($json, 'idreference', $midia->Idreference);
			$midia->Mediatype = $this->SafeGetVal($json, 'mediatype', $midia->Mediatype);
			$midia->Mediaurl = $this->SafeGetVal($json, 'mediaurl', $midia->Mediaurl);
			$midia->Digitizationdate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'digitizationdate', $midia->Digitizationdate)));
			$midia->Digitizationresponsable = $this->SafeGetVal($json, 'digitizationresponsable', $midia->Digitizationresponsable);
			$midia->Polarity = $this->SafeGetVal($json, 'polarity', $midia->Polarity);
			$midia->Colorspace = $this->SafeGetVal($json, 'colorspace', $midia->Colorspace);
			$midia->Iccprofile = $this->SafeGetVal($json, 'iccprofile', $midia->Iccprofile);
			$midia->Xresolution = $this->SafeGetVal($json, 'xresolution', $midia->Xresolution);
			$midia->Yresolution = $this->SafeGetVal($json, 'yresolution', $midia->Yresolution);
			$midia->Thumbnail = $this->SafeGetVal($json, 'thumbnail', $midia->Thumbnail);
			$midia->Digitizationequipment = $this->SafeGetVal($json, 'digitizationequipment', $midia->Digitizationequipment);
			$midia->Format = $this->SafeGetVal($json, 'format', $midia->Format);
			$midia->Ispublic = $this->SafeGetVal($json, 'ispublic', $midia->Ispublic);
			$midia->Ordername = $this->SafeGetVal($json, 'ordername', $midia->Ordername);
			$midia->Sent = $this->SafeGetVal($json, 'sent', $midia->Sent);
			$midia->Exif = $this->SafeGetVal($json, 'exif', $midia->Exif);
			$midia->Textual = $this->SafeGetVal($json, 'textual', $midia->Textual);
			$midia->Sizemedia = $this->SafeGetVal($json, 'sizemedia', $midia->Sizemedia);
			$midia->Nameoriginal = $this->SafeGetVal($json, 'nameoriginal', $midia->Nameoriginal);
			$midia->Mainmedia = $this->SafeGetVal($json, 'mainmedia', $midia->Mainmedia);
			$midia->Mediadir = $this->SafeGetVal($json, 'mediadir', $midia->Mediadir);
			$midia->Thumbnaildir = $this->SafeGetVal($json, 'thumbnaildir', $midia->Thumbnaildir);
			$midia->Thumbnailurl = $this->SafeGetVal($json, 'thumbnailurl', $midia->Thumbnailurl);

			$midia->Validate();
			$errors = $midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$midia->Save();
				$this->RenderJSON($midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing midia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idmedia');
			$midia = $this->Phreezer->Get('midia',$pk);

			$midia->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
