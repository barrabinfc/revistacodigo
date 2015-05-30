<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/descricao_fisica.php");

/**
 * descricao_fisicaController is the controller class for the descricao_fisica object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class descricao_fisicaController extends AppBaseController
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
	 * Displays a list view of descricao_fisica objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for descricao_fisica records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new descricao_fisicaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Item,Apexiso,Arabicpagenumbering,Asaiso,Boundtype,Color,Colorsystem,Columnnumber,Compressionmethod,Contentcolor,Contentextent,Contentfinishing,Contentsubstract,Contenttype,Covercolor,Coverfinishing,Coversubstract,Defaultapplication,Dustjacketcolor,Dustjacketfinishing,Dustjacketsubstract,Endpaper,Exif,Format,Framerate,Hasdustjacket,Hassound,Hasspecialfold,Iscompressed,Lengthtxt,Master,Media,Mediasupport,Movements,Other,Projectionmode,Romanpage,Sizetxt,Soundsystem,Specialfold,Specialpagenumebring,Technique,Timecode,Tinting,Titlepage,Totaltime,Type,Writingformat'
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

				$descricoes_fisicas = $this->Phreezer->Query('descricao_fisica',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $descricoes_fisicas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $descricoes_fisicas->TotalResults;
				$output->totalPages = $descricoes_fisicas->TotalPages;
				$output->pageSize = $descricoes_fisicas->PageSize;
				$output->currentPage = $descricoes_fisicas->CurrentPage;
			}
			else
			{
				// return all results
				$descricoes_fisicas = $this->Phreezer->Query('descricao_fisica',$criteria);
				$output->rows = $descricoes_fisicas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single descricao_fisica record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$descricao_fisica = $this->Phreezer->Get('descricao_fisica',$pk);
			$this->RenderJSON($descricao_fisica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new descricao_fisica record and render response as JSON
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

			$descricao_fisica = new descricao_fisica($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $descricao_fisica->Id = $this->SafeGetVal($json, 'id');

			$descricao_fisica->Item = $this->SafeGetVal($json, 'item');
			$descricao_fisica->Apexiso = $this->SafeGetVal($json, 'apexiso');
			$descricao_fisica->Arabicpagenumbering = $this->SafeGetVal($json, 'arabicpagenumbering');
			$descricao_fisica->Asaiso = $this->SafeGetVal($json, 'asaiso');
			$descricao_fisica->Boundtype = $this->SafeGetVal($json, 'boundtype');
			$descricao_fisica->Color = $this->SafeGetVal($json, 'color');
			$descricao_fisica->Colorsystem = $this->SafeGetVal($json, 'colorsystem');
			$descricao_fisica->Columnnumber = $this->SafeGetVal($json, 'columnnumber');
			$descricao_fisica->Compressionmethod = $this->SafeGetVal($json, 'compressionmethod');
			$descricao_fisica->Contentcolor = $this->SafeGetVal($json, 'contentcolor');
			$descricao_fisica->Contentextent = $this->SafeGetVal($json, 'contentextent');
			$descricao_fisica->Contentfinishing = $this->SafeGetVal($json, 'contentfinishing');
			$descricao_fisica->Contentsubstract = $this->SafeGetVal($json, 'contentsubstract');
			$descricao_fisica->Contenttype = $this->SafeGetVal($json, 'contenttype');
			$descricao_fisica->Covercolor = $this->SafeGetVal($json, 'covercolor');
			$descricao_fisica->Coverfinishing = $this->SafeGetVal($json, 'coverfinishing');
			$descricao_fisica->Coversubstract = $this->SafeGetVal($json, 'coversubstract');
			$descricao_fisica->Defaultapplication = $this->SafeGetVal($json, 'defaultapplication');
			$descricao_fisica->Dustjacketcolor = $this->SafeGetVal($json, 'dustjacketcolor');
			$descricao_fisica->Dustjacketfinishing = $this->SafeGetVal($json, 'dustjacketfinishing');
			$descricao_fisica->Dustjacketsubstract = $this->SafeGetVal($json, 'dustjacketsubstract');
			$descricao_fisica->Endpaper = $this->SafeGetVal($json, 'endpaper');
			$descricao_fisica->Exif = $this->SafeGetVal($json, 'exif');
			$descricao_fisica->Format = $this->SafeGetVal($json, 'format');
			$descricao_fisica->Framerate = $this->SafeGetVal($json, 'framerate');
			$descricao_fisica->Hasdustjacket = $this->SafeGetVal($json, 'hasdustjacket');
			$descricao_fisica->Hassound = $this->SafeGetVal($json, 'hassound');
			$descricao_fisica->Hasspecialfold = $this->SafeGetVal($json, 'hasspecialfold');
			$descricao_fisica->Iscompressed = $this->SafeGetVal($json, 'iscompressed');
			$descricao_fisica->Lengthtxt = $this->SafeGetVal($json, 'lengthtxt');
			$descricao_fisica->Master = $this->SafeGetVal($json, 'master');
			$descricao_fisica->Media = $this->SafeGetVal($json, 'media');
			$descricao_fisica->Mediasupport = $this->SafeGetVal($json, 'mediasupport');
			$descricao_fisica->Movements = $this->SafeGetVal($json, 'movements');
			$descricao_fisica->Other = $this->SafeGetVal($json, 'other');
			$descricao_fisica->Projectionmode = $this->SafeGetVal($json, 'projectionmode');
			$descricao_fisica->Romanpage = $this->SafeGetVal($json, 'romanpage');
			$descricao_fisica->Sizetxt = $this->SafeGetVal($json, 'sizetxt');
			$descricao_fisica->Soundsystem = $this->SafeGetVal($json, 'soundsystem');
			$descricao_fisica->Specialfold = $this->SafeGetVal($json, 'specialfold');
			$descricao_fisica->Specialpagenumebring = $this->SafeGetVal($json, 'specialpagenumebring');
			$descricao_fisica->Technique = $this->SafeGetVal($json, 'technique');
			$descricao_fisica->Timecode = $this->SafeGetVal($json, 'timecode');
			$descricao_fisica->Tinting = $this->SafeGetVal($json, 'tinting');
			$descricao_fisica->Titlepage = $this->SafeGetVal($json, 'titlepage');
			$descricao_fisica->Totaltime = $this->SafeGetVal($json, 'totaltime');
			$descricao_fisica->Type = $this->SafeGetVal($json, 'type');
			$descricao_fisica->Writingformat = $this->SafeGetVal($json, 'writingformat');

			$descricao_fisica->Validate();
			$errors = $descricao_fisica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$descricao_fisica->Save();
				$this->RenderJSON($descricao_fisica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing descricao_fisica record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('id');
			$descricao_fisica = $this->Phreezer->Get('descricao_fisica',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $descricao_fisica->Id = $this->SafeGetVal($json, 'id', $descricao_fisica->Id);

			$descricao_fisica->Item = $this->SafeGetVal($json, 'item', $descricao_fisica->Item);
			$descricao_fisica->Apexiso = $this->SafeGetVal($json, 'apexiso', $descricao_fisica->Apexiso);
			$descricao_fisica->Arabicpagenumbering = $this->SafeGetVal($json, 'arabicpagenumbering', $descricao_fisica->Arabicpagenumbering);
			$descricao_fisica->Asaiso = $this->SafeGetVal($json, 'asaiso', $descricao_fisica->Asaiso);
			$descricao_fisica->Boundtype = $this->SafeGetVal($json, 'boundtype', $descricao_fisica->Boundtype);
			$descricao_fisica->Color = $this->SafeGetVal($json, 'color', $descricao_fisica->Color);
			$descricao_fisica->Colorsystem = $this->SafeGetVal($json, 'colorsystem', $descricao_fisica->Colorsystem);
			$descricao_fisica->Columnnumber = $this->SafeGetVal($json, 'columnnumber', $descricao_fisica->Columnnumber);
			$descricao_fisica->Compressionmethod = $this->SafeGetVal($json, 'compressionmethod', $descricao_fisica->Compressionmethod);
			$descricao_fisica->Contentcolor = $this->SafeGetVal($json, 'contentcolor', $descricao_fisica->Contentcolor);
			$descricao_fisica->Contentextent = $this->SafeGetVal($json, 'contentextent', $descricao_fisica->Contentextent);
			$descricao_fisica->Contentfinishing = $this->SafeGetVal($json, 'contentfinishing', $descricao_fisica->Contentfinishing);
			$descricao_fisica->Contentsubstract = $this->SafeGetVal($json, 'contentsubstract', $descricao_fisica->Contentsubstract);
			$descricao_fisica->Contenttype = $this->SafeGetVal($json, 'contenttype', $descricao_fisica->Contenttype);
			$descricao_fisica->Covercolor = $this->SafeGetVal($json, 'covercolor', $descricao_fisica->Covercolor);
			$descricao_fisica->Coverfinishing = $this->SafeGetVal($json, 'coverfinishing', $descricao_fisica->Coverfinishing);
			$descricao_fisica->Coversubstract = $this->SafeGetVal($json, 'coversubstract', $descricao_fisica->Coversubstract);
			$descricao_fisica->Defaultapplication = $this->SafeGetVal($json, 'defaultapplication', $descricao_fisica->Defaultapplication);
			$descricao_fisica->Dustjacketcolor = $this->SafeGetVal($json, 'dustjacketcolor', $descricao_fisica->Dustjacketcolor);
			$descricao_fisica->Dustjacketfinishing = $this->SafeGetVal($json, 'dustjacketfinishing', $descricao_fisica->Dustjacketfinishing);
			$descricao_fisica->Dustjacketsubstract = $this->SafeGetVal($json, 'dustjacketsubstract', $descricao_fisica->Dustjacketsubstract);
			$descricao_fisica->Endpaper = $this->SafeGetVal($json, 'endpaper', $descricao_fisica->Endpaper);
			$descricao_fisica->Exif = $this->SafeGetVal($json, 'exif', $descricao_fisica->Exif);
			$descricao_fisica->Format = $this->SafeGetVal($json, 'format', $descricao_fisica->Format);
			$descricao_fisica->Framerate = $this->SafeGetVal($json, 'framerate', $descricao_fisica->Framerate);
			$descricao_fisica->Hasdustjacket = $this->SafeGetVal($json, 'hasdustjacket', $descricao_fisica->Hasdustjacket);
			$descricao_fisica->Hassound = $this->SafeGetVal($json, 'hassound', $descricao_fisica->Hassound);
			$descricao_fisica->Hasspecialfold = $this->SafeGetVal($json, 'hasspecialfold', $descricao_fisica->Hasspecialfold);
			$descricao_fisica->Iscompressed = $this->SafeGetVal($json, 'iscompressed', $descricao_fisica->Iscompressed);
			$descricao_fisica->Lengthtxt = $this->SafeGetVal($json, 'lengthtxt', $descricao_fisica->Lengthtxt);
			$descricao_fisica->Master = $this->SafeGetVal($json, 'master', $descricao_fisica->Master);
			$descricao_fisica->Media = $this->SafeGetVal($json, 'media', $descricao_fisica->Media);
			$descricao_fisica->Mediasupport = $this->SafeGetVal($json, 'mediasupport', $descricao_fisica->Mediasupport);
			$descricao_fisica->Movements = $this->SafeGetVal($json, 'movements', $descricao_fisica->Movements);
			$descricao_fisica->Other = $this->SafeGetVal($json, 'other', $descricao_fisica->Other);
			$descricao_fisica->Projectionmode = $this->SafeGetVal($json, 'projectionmode', $descricao_fisica->Projectionmode);
			$descricao_fisica->Romanpage = $this->SafeGetVal($json, 'romanpage', $descricao_fisica->Romanpage);
			$descricao_fisica->Sizetxt = $this->SafeGetVal($json, 'sizetxt', $descricao_fisica->Sizetxt);
			$descricao_fisica->Soundsystem = $this->SafeGetVal($json, 'soundsystem', $descricao_fisica->Soundsystem);
			$descricao_fisica->Specialfold = $this->SafeGetVal($json, 'specialfold', $descricao_fisica->Specialfold);
			$descricao_fisica->Specialpagenumebring = $this->SafeGetVal($json, 'specialpagenumebring', $descricao_fisica->Specialpagenumebring);
			$descricao_fisica->Technique = $this->SafeGetVal($json, 'technique', $descricao_fisica->Technique);
			$descricao_fisica->Timecode = $this->SafeGetVal($json, 'timecode', $descricao_fisica->Timecode);
			$descricao_fisica->Tinting = $this->SafeGetVal($json, 'tinting', $descricao_fisica->Tinting);
			$descricao_fisica->Titlepage = $this->SafeGetVal($json, 'titlepage', $descricao_fisica->Titlepage);
			$descricao_fisica->Totaltime = $this->SafeGetVal($json, 'totaltime', $descricao_fisica->Totaltime);
			$descricao_fisica->Type = $this->SafeGetVal($json, 'type', $descricao_fisica->Type);
			$descricao_fisica->Writingformat = $this->SafeGetVal($json, 'writingformat', $descricao_fisica->Writingformat);

			$descricao_fisica->Validate();
			$errors = $descricao_fisica->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$descricao_fisica->Save();
				$this->RenderJSON($descricao_fisica, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing descricao_fisica record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$descricao_fisica = $this->Phreezer->Get('descricao_fisica',$pk);

			$descricao_fisica->Delete();

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
