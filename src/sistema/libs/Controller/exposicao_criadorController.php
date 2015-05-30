<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/exposicao_criador.php");

/**
 * exposicao_criadorController is the controller class for the exposicao_criador object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class exposicao_criadorController extends AppBaseController
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
	 * Displays a list view of exposicao_criador objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for exposicao_criador records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new exposicao_criadorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Attributed,Location,Type,Creator,Exposition'
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

				$exposicao_criadores = $this->Phreezer->Query('exposicao_criador',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $exposicao_criadores->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $exposicao_criadores->TotalResults;
				$output->totalPages = $exposicao_criadores->TotalPages;
				$output->pageSize = $exposicao_criadores->PageSize;
				$output->currentPage = $exposicao_criadores->CurrentPage;
			}
			else
			{
				// return all results
				$exposicao_criadores = $this->Phreezer->Query('exposicao_criador',$criteria);
				$output->rows = $exposicao_criadores->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single exposicao_criador record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$exposicao_criador = $this->Phreezer->Get('exposicao_criador',$pk);
			$this->RenderJSON($exposicao_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new exposicao_criador record and render response as JSON
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

			$exposicao_criador = new exposicao_criador($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $exposicao_criador->Id = $this->SafeGetVal($json, 'id');

			$exposicao_criador->Attributed = $this->SafeGetVal($json, 'attributed');
			$exposicao_criador->Location = $this->SafeGetVal($json, 'location');
			$exposicao_criador->Type = $this->SafeGetVal($json, 'type');
			$exposicao_criador->Creator = $this->SafeGetVal($json, 'creator');
			$exposicao_criador->Exposition = $this->SafeGetVal($json, 'exposition');

			$exposicao_criador->Validate();
			$errors = $exposicao_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exposicao_criador->Save();
				$this->RenderJSON($exposicao_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing exposicao_criador record and render response as JSON
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
			$exposicao_criador = $this->Phreezer->Get('exposicao_criador',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $exposicao_criador->Id = $this->SafeGetVal($json, 'id', $exposicao_criador->Id);

			$exposicao_criador->Attributed = $this->SafeGetVal($json, 'attributed', $exposicao_criador->Attributed);
			$exposicao_criador->Location = $this->SafeGetVal($json, 'location', $exposicao_criador->Location);
			$exposicao_criador->Type = $this->SafeGetVal($json, 'type', $exposicao_criador->Type);
			$exposicao_criador->Creator = $this->SafeGetVal($json, 'creator', $exposicao_criador->Creator);
			$exposicao_criador->Exposition = $this->SafeGetVal($json, 'exposition', $exposicao_criador->Exposition);

			$exposicao_criador->Validate();
			$errors = $exposicao_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$exposicao_criador->Save();
				$this->RenderJSON($exposicao_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing exposicao_criador record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$exposicao_criador = $this->Phreezer->Get('exposicao_criador',$pk);

			$exposicao_criador->Delete();

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
