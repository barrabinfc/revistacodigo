<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/n_referencia.php");

/**
 * n_referenciaController is the controller class for the n_referencia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class n_referenciaController extends AppBaseController
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
	 * Displays a list view of n_referencia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for n_referencia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new n_referenciaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Author,Description,OtherInformation,Text,Title,Institution'
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

				$n_referencias = $this->Phreezer->Query('n_referencia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $n_referencias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $n_referencias->TotalResults;
				$output->totalPages = $n_referencias->TotalPages;
				$output->pageSize = $n_referencias->PageSize;
				$output->currentPage = $n_referencias->CurrentPage;
			}
			else
			{
				// return all results
				$n_referencias = $this->Phreezer->Query('n_referencia',$criteria);
				$output->rows = $n_referencias->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single n_referencia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$n_referencia = $this->Phreezer->Get('n_referencia',$pk);
			$this->RenderJSON($n_referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new n_referencia record and render response as JSON
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

			$n_referencia = new n_referencia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $n_referencia->Id = $this->SafeGetVal($json, 'id');

			$n_referencia->Author = $this->SafeGetVal($json, 'author');
			$n_referencia->Description = $this->SafeGetVal($json, 'description');
			$n_referencia->OtherInformation = $this->SafeGetVal($json, 'otherInformation');
			$n_referencia->Text = $this->SafeGetVal($json, 'text');
			$n_referencia->Title = $this->SafeGetVal($json, 'title');
			$n_referencia->Institution = $this->SafeGetVal($json, 'institution');

			$n_referencia->Validate();
			$errors = $n_referencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_referencia->Save();
				$this->RenderJSON($n_referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing n_referencia record and render response as JSON
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
			$n_referencia = $this->Phreezer->Get('n_referencia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $n_referencia->Id = $this->SafeGetVal($json, 'id', $n_referencia->Id);

			$n_referencia->Author = $this->SafeGetVal($json, 'author', $n_referencia->Author);
			$n_referencia->Description = $this->SafeGetVal($json, 'description', $n_referencia->Description);
			$n_referencia->OtherInformation = $this->SafeGetVal($json, 'otherInformation', $n_referencia->OtherInformation);
			$n_referencia->Text = $this->SafeGetVal($json, 'text', $n_referencia->Text);
			$n_referencia->Title = $this->SafeGetVal($json, 'title', $n_referencia->Title);
			$n_referencia->Institution = $this->SafeGetVal($json, 'institution', $n_referencia->Institution);

			$n_referencia->Validate();
			$errors = $n_referencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$n_referencia->Save();
				$this->RenderJSON($n_referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing n_referencia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$n_referencia = $this->Phreezer->Get('n_referencia',$pk);

			$n_referencia->Delete();

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
