<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/local_exposicao.php");

/**
 * local_exposicaoController is the controller class for the local_exposicao object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class local_exposicaoController extends AppBaseController
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
	 * Displays a list view of local_exposicao objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for local_exposicao records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new local_exposicaoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Type,Contact,Placelocation,Exposition'
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

				$locais_exposicoes = $this->Phreezer->Query('local_exposicao',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $locais_exposicoes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $locais_exposicoes->TotalResults;
				$output->totalPages = $locais_exposicoes->TotalPages;
				$output->pageSize = $locais_exposicoes->PageSize;
				$output->currentPage = $locais_exposicoes->CurrentPage;
			}
			else
			{
				// return all results
				$locais_exposicoes = $this->Phreezer->Query('local_exposicao',$criteria);
				$output->rows = $locais_exposicoes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single local_exposicao record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$local_exposicao = $this->Phreezer->Get('local_exposicao',$pk);
			$this->RenderJSON($local_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new local_exposicao record and render response as JSON
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

			$local_exposicao = new local_exposicao($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $local_exposicao->Id = $this->SafeGetVal($json, 'id');

			$local_exposicao->Type = $this->SafeGetVal($json, 'type');
			$local_exposicao->Contact = $this->SafeGetVal($json, 'contact');
			$local_exposicao->Placelocation = $this->SafeGetVal($json, 'placelocation');
			$local_exposicao->Exposition = $this->SafeGetVal($json, 'exposition');

			$local_exposicao->Validate();
			$errors = $local_exposicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$local_exposicao->Save();
				$this->RenderJSON($local_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing local_exposicao record and render response as JSON
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
			$local_exposicao = $this->Phreezer->Get('local_exposicao',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $local_exposicao->Id = $this->SafeGetVal($json, 'id', $local_exposicao->Id);

			$local_exposicao->Type = $this->SafeGetVal($json, 'type', $local_exposicao->Type);
			$local_exposicao->Contact = $this->SafeGetVal($json, 'contact', $local_exposicao->Contact);
			$local_exposicao->Placelocation = $this->SafeGetVal($json, 'placelocation', $local_exposicao->Placelocation);
			$local_exposicao->Exposition = $this->SafeGetVal($json, 'exposition', $local_exposicao->Exposition);

			$local_exposicao->Validate();
			$errors = $local_exposicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$local_exposicao->Save();
				$this->RenderJSON($local_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing local_exposicao record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$local_exposicao = $this->Phreezer->Get('local_exposicao',$pk);

			$local_exposicao->Delete();

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
