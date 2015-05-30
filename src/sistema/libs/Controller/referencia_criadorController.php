<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/referencia_criador.php");

/**
 * referencia_criadorController is the controller class for the referencia_criador object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class referencia_criadorController extends AppBaseController
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
	 * Displays a list view of referencia_criador objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for referencia_criador records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new referencia_criadorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Type,Creator,Reference'
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

				$referencias_criadores = $this->Phreezer->Query('referencia_criador',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $referencias_criadores->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $referencias_criadores->TotalResults;
				$output->totalPages = $referencias_criadores->TotalPages;
				$output->pageSize = $referencias_criadores->PageSize;
				$output->currentPage = $referencias_criadores->CurrentPage;
			}
			else
			{
				// return all results
				$referencias_criadores = $this->Phreezer->Query('referencia_criador',$criteria);
				$output->rows = $referencias_criadores->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single referencia_criador record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$referencia_criador = $this->Phreezer->Get('referencia_criador',$pk);
			$this->RenderJSON($referencia_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new referencia_criador record and render response as JSON
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

			$referencia_criador = new referencia_criador($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $referencia_criador->Id = $this->SafeGetVal($json, 'id');

			$referencia_criador->Type = $this->SafeGetVal($json, 'type');
			$referencia_criador->Creator = $this->SafeGetVal($json, 'creator');
			$referencia_criador->Reference = $this->SafeGetVal($json, 'reference');

			$referencia_criador->Validate();
			$errors = $referencia_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia_criador->Save();
				$this->RenderJSON($referencia_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing referencia_criador record and render response as JSON
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
			$referencia_criador = $this->Phreezer->Get('referencia_criador',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $referencia_criador->Id = $this->SafeGetVal($json, 'id', $referencia_criador->Id);

			$referencia_criador->Type = $this->SafeGetVal($json, 'type', $referencia_criador->Type);
			$referencia_criador->Creator = $this->SafeGetVal($json, 'creator', $referencia_criador->Creator);
			$referencia_criador->Reference = $this->SafeGetVal($json, 'reference', $referencia_criador->Reference);

			$referencia_criador->Validate();
			$errors = $referencia_criador->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia_criador->Save();
				$this->RenderJSON($referencia_criador, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing referencia_criador record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$referencia_criador = $this->Phreezer->Get('referencia_criador',$pk);

			$referencia_criador->Delete();

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
