<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/nivel_instituicoes.php");

/**
 * nivel_instituicoesController is the controller class for the nivel_instituicoes object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class nivel_instituicoesController extends AppBaseController
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
	 * Displays a list view of nivel_instituicoes objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for nivel_instituicoes records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new nivel_instituicoesCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('InstitutionIdinstitution,LevelsIdlevel'
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

				$niveis_instituicoes = $this->Phreezer->Query('nivel_instituicoes',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $niveis_instituicoes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $niveis_instituicoes->TotalResults;
				$output->totalPages = $niveis_instituicoes->TotalPages;
				$output->pageSize = $niveis_instituicoes->PageSize;
				$output->currentPage = $niveis_instituicoes->CurrentPage;
			}
			else
			{
				// return all results
				$niveis_instituicoes = $this->Phreezer->Query('nivel_instituicoes',$criteria);
				$output->rows = $niveis_instituicoes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single nivel_instituicoes record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('institutionIdinstitution');
			$nivel_instituicoes = $this->Phreezer->Get('nivel_instituicoes',$pk);
			$this->RenderJSON($nivel_instituicoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new nivel_instituicoes record and render response as JSON
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

			$nivel_instituicoes = new nivel_instituicoes($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			$nivel_instituicoes->InstitutionIdinstitution = $this->SafeGetVal($json, 'institutionIdinstitution');
			$nivel_instituicoes->LevelsIdlevel = $this->SafeGetVal($json, 'levelsIdlevel');

			$nivel_instituicoes->Validate();
			$errors = $nivel_instituicoes->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				// since the primary key is not auto-increment we must force the insert here
				$nivel_instituicoes->Save(true);
				$this->RenderJSON($nivel_instituicoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing nivel_instituicoes record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('institutionIdinstitution');
			$nivel_instituicoes = $this->Phreezer->Get('nivel_instituicoes',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $nivel_instituicoes->InstitutionIdinstitution = $this->SafeGetVal($json, 'institutionIdinstitution', $nivel_instituicoes->InstitutionIdinstitution);

			// this is a primary key.  uncomment if updating is allowed
			// $nivel_instituicoes->LevelsIdlevel = $this->SafeGetVal($json, 'levelsIdlevel', $nivel_instituicoes->LevelsIdlevel);


			$nivel_instituicoes->Validate();
			$errors = $nivel_instituicoes->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$nivel_instituicoes->Save();
				$this->RenderJSON($nivel_instituicoes, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{

			// this table does not have an auto-increment primary key, so it is semantically correct to
			// issue a REST PUT request, however we have no way to know whether to insert or update.
			// if the record is not found, this exception will indicate that this is an insert request
			if (is_a($ex,'NotFoundException'))
			{
				return $this->Create();
			}

			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing nivel_instituicoes record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('institutionIdinstitution');
			$nivel_instituicoes = $this->Phreezer->Get('nivel_instituicoes',$pk);

			$nivel_instituicoes->Delete();

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
