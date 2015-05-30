<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/busca.php");

/**
 * buscaController is the controller class for the busca object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class buscaController extends AppBaseController
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
	 * Displays a list view of busca objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for busca records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new buscaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idsearch,User,Name,Info,Type,Datecreate'
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

				$buscas = $this->Phreezer->Query('busca',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $buscas->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $buscas->TotalResults;
				$output->totalPages = $buscas->TotalPages;
				$output->pageSize = $buscas->PageSize;
				$output->currentPage = $buscas->CurrentPage;
			}
			else
			{
				// return all results
				$buscas = $this->Phreezer->Query('busca',$criteria);
				$output->rows = $buscas->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single busca record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idsearch');
			$busca = $this->Phreezer->Get('busca',$pk);
			$this->RenderJSON($busca, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new busca record and render response as JSON
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

			$busca = new busca($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $busca->Idsearch = $this->SafeGetVal($json, 'idsearch');

			$busca->User = $this->SafeGetVal($json, 'user');
			$busca->Name = $this->SafeGetVal($json, 'name');
			$busca->Info = $this->SafeGetVal($json, 'info');
			$busca->Type = $this->SafeGetVal($json, 'type');
			$busca->Datecreate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'datecreate')));

			$busca->Validate();
			$errors = $busca->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$busca->Save();
				$this->RenderJSON($busca, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing busca record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idsearch');
			$busca = $this->Phreezer->Get('busca',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $busca->Idsearch = $this->SafeGetVal($json, 'idsearch', $busca->Idsearch);

			$busca->User = $this->SafeGetVal($json, 'user', $busca->User);
			$busca->Name = $this->SafeGetVal($json, 'name', $busca->Name);
			$busca->Info = $this->SafeGetVal($json, 'info', $busca->Info);
			$busca->Type = $this->SafeGetVal($json, 'type', $busca->Type);
			$busca->Datecreate = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'datecreate', $busca->Datecreate)));

			$busca->Validate();
			$errors = $busca->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$busca->Save();
				$this->RenderJSON($busca, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing busca record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idsearch');
			$busca = $this->Phreezer->Get('busca',$pk);

			$busca->Delete();

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
