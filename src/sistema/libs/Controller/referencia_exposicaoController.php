<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/referencia_exposicao.php");

/**
 * referencia_exposicaoController is the controller class for the referencia_exposicao object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class referencia_exposicaoController extends AppBaseController
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
	 * Displays a list view of referencia_exposicao objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for referencia_exposicao records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new referencia_exposicaoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Type,Exposition,Reference'
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

				$referencia_exposicoes = $this->Phreezer->Query('referencia_exposicao',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $referencia_exposicoes->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $referencia_exposicoes->TotalResults;
				$output->totalPages = $referencia_exposicoes->TotalPages;
				$output->pageSize = $referencia_exposicoes->PageSize;
				$output->currentPage = $referencia_exposicoes->CurrentPage;
			}
			else
			{
				// return all results
				$referencia_exposicoes = $this->Phreezer->Query('referencia_exposicao',$criteria);
				$output->rows = $referencia_exposicoes->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single referencia_exposicao record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$referencia_exposicao = $this->Phreezer->Get('referencia_exposicao',$pk);
			$this->RenderJSON($referencia_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new referencia_exposicao record and render response as JSON
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

			$referencia_exposicao = new referencia_exposicao($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $referencia_exposicao->Id = $this->SafeGetVal($json, 'id');

			$referencia_exposicao->Type = $this->SafeGetVal($json, 'type');
			$referencia_exposicao->Exposition = $this->SafeGetVal($json, 'exposition');
			$referencia_exposicao->Reference = $this->SafeGetVal($json, 'reference');

			$referencia_exposicao->Validate();
			$errors = $referencia_exposicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia_exposicao->Save();
				$this->RenderJSON($referencia_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing referencia_exposicao record and render response as JSON
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
			$referencia_exposicao = $this->Phreezer->Get('referencia_exposicao',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $referencia_exposicao->Id = $this->SafeGetVal($json, 'id', $referencia_exposicao->Id);

			$referencia_exposicao->Type = $this->SafeGetVal($json, 'type', $referencia_exposicao->Type);
			$referencia_exposicao->Exposition = $this->SafeGetVal($json, 'exposition', $referencia_exposicao->Exposition);
			$referencia_exposicao->Reference = $this->SafeGetVal($json, 'reference', $referencia_exposicao->Reference);

			$referencia_exposicao->Validate();
			$errors = $referencia_exposicao->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia_exposicao->Save();
				$this->RenderJSON($referencia_exposicao, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing referencia_exposicao record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$referencia_exposicao = $this->Phreezer->Get('referencia_exposicao',$pk);

			$referencia_exposicao->Delete();

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
