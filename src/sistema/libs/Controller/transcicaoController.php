<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/transcicao.php");

/**
 * transcicaoController is the controller class for the transcicao object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class transcicaoController extends AppBaseController
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
	 * Displays a list view of transcicao objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for transcicao records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new transcicaoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idtranscription,Iditem,Idmedia,Institution,Transcription,Notes,Language'
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

				$transcricoes = $this->Phreezer->Query('transcicao',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $transcricoes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $transcricoes->TotalResults;
				$output->totalPages = $transcricoes->TotalPages;
				$output->pageSize = $transcricoes->PageSize;
				$output->currentPage = $transcricoes->CurrentPage;
			}
			else
			{
				// return all results
				$transcricoes = $this->Phreezer->Query('transcicao',$criteria);
				$output->rows = $transcricoes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single transcicao record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idtranscription');
			$transcicao = $this->Phreezer->Get('transcicao',$pk);
			$this->RenderJSON($transcicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new transcicao record and render response as JSON
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

			$transcicao = new transcicao($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $transcicao->Idtranscription = $this->SafeGetVal($json, 'idtranscription');

			$transcicao->Iditem = $this->SafeGetVal($json, 'iditem');
			$transcicao->Idmedia = $this->SafeGetVal($json, 'idmedia');
			$transcicao->Institution = $this->SafeGetVal($json, 'institution');
			$transcicao->Transcription = $this->SafeGetVal($json, 'transcription');
			$transcicao->Notes = $this->SafeGetVal($json, 'notes');
			$transcicao->Language = $this->SafeGetVal($json, 'language');

			$transcicao->Validate();
			$errors = $transcicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$transcicao->Save();
				$this->RenderJSON($transcicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing transcicao record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idtranscription');
			$transcicao = $this->Phreezer->Get('transcicao',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $transcicao->Idtranscription = $this->SafeGetVal($json, 'idtranscription', $transcicao->Idtranscription);

			$transcicao->Iditem = $this->SafeGetVal($json, 'iditem', $transcicao->Iditem);
			$transcicao->Idmedia = $this->SafeGetVal($json, 'idmedia', $transcicao->Idmedia);
			$transcicao->Institution = $this->SafeGetVal($json, 'institution', $transcicao->Institution);
			$transcicao->Transcription = $this->SafeGetVal($json, 'transcription', $transcicao->Transcription);
			$transcicao->Notes = $this->SafeGetVal($json, 'notes', $transcicao->Notes);
			$transcicao->Language = $this->SafeGetVal($json, 'language', $transcicao->Language);

			$transcicao->Validate();
			$errors = $transcicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$transcicao->Save();
				$this->RenderJSON($transcicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing transcicao record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idtranscription');
			$transcicao = $this->Phreezer->Get('transcicao',$pk);

			$transcicao->Delete();

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
