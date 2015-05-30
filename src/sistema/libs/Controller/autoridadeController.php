<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/autoridade.php");

/**
 * autoridadeController is the controller class for the autoridade object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class autoridadeController extends AppBaseController
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
	 * Displays a list view of autoridade objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for autoridade records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new autoridadeCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idauthority,Name,Audisplay,Aulist,Auinsert,Auupdate,Auread,Audelete,Auexecute,Auexport,Module,Institution'
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

				$authorities = $this->Phreezer->Query('autoridade',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $authorities->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $authorities->TotalResults;
				$output->totalPages = $authorities->TotalPages;
				$output->pageSize = $authorities->PageSize;
				$output->currentPage = $authorities->CurrentPage;
			}
			else
			{
				// return all results
				$authorities = $this->Phreezer->Query('autoridade',$criteria);
				$output->rows = $authorities->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single autoridade record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idauthority');
			$autoridade = $this->Phreezer->Get('autoridade',$pk);
			$this->RenderJSON($autoridade, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new autoridade record and render response as JSON
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

			$autoridade = new autoridade($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $autoridade->Idauthority = $this->SafeGetVal($json, 'idauthority');

			$autoridade->Name = $this->SafeGetVal($json, 'name');
			$autoridade->Audisplay = $this->SafeGetVal($json, 'audisplay');
			$autoridade->Aulist = $this->SafeGetVal($json, 'aulist');
			$autoridade->Auinsert = $this->SafeGetVal($json, 'auinsert');
			$autoridade->Auupdate = $this->SafeGetVal($json, 'auupdate');
			$autoridade->Auread = $this->SafeGetVal($json, 'auread');
			$autoridade->Audelete = $this->SafeGetVal($json, 'audelete');
			$autoridade->Auexecute = $this->SafeGetVal($json, 'auexecute');
			$autoridade->Auexport = $this->SafeGetVal($json, 'auexport');
			$autoridade->Module = $this->SafeGetVal($json, 'module');
			$autoridade->Institution = $this->SafeGetVal($json, 'institution');

			$autoridade->Validate();
			$errors = $autoridade->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$autoridade->Save();
				$this->RenderJSON($autoridade, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing autoridade record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idauthority');
			$autoridade = $this->Phreezer->Get('autoridade',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $autoridade->Idauthority = $this->SafeGetVal($json, 'idauthority', $autoridade->Idauthority);

			$autoridade->Name = $this->SafeGetVal($json, 'name', $autoridade->Name);
			$autoridade->Audisplay = $this->SafeGetVal($json, 'audisplay', $autoridade->Audisplay);
			$autoridade->Aulist = $this->SafeGetVal($json, 'aulist', $autoridade->Aulist);
			$autoridade->Auinsert = $this->SafeGetVal($json, 'auinsert', $autoridade->Auinsert);
			$autoridade->Auupdate = $this->SafeGetVal($json, 'auupdate', $autoridade->Auupdate);
			$autoridade->Auread = $this->SafeGetVal($json, 'auread', $autoridade->Auread);
			$autoridade->Audelete = $this->SafeGetVal($json, 'audelete', $autoridade->Audelete);
			$autoridade->Auexecute = $this->SafeGetVal($json, 'auexecute', $autoridade->Auexecute);
			$autoridade->Auexport = $this->SafeGetVal($json, 'auexport', $autoridade->Auexport);
			$autoridade->Module = $this->SafeGetVal($json, 'module', $autoridade->Module);
			$autoridade->Institution = $this->SafeGetVal($json, 'institution', $autoridade->Institution);

			$autoridade->Validate();
			$errors = $autoridade->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$autoridade->Save();
				$this->RenderJSON($autoridade, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing autoridade record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idauthority');
			$autoridade = $this->Phreezer->Get('autoridade',$pk);

			$autoridade->Delete();

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
