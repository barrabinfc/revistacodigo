<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/documento_midia.php");

/**
 * documento_midiaController is the controller class for the documento_midia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class documento_midiaController extends AppBaseController
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
	 * Displays a list view of documento_midia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for documento_midia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new documento_midiaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('DocumentationIddocumentation,MediasIdmedia'
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

				$documentos_midias = $this->Phreezer->Query('documento_midia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $documentos_midias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $documentos_midias->TotalResults;
				$output->totalPages = $documentos_midias->TotalPages;
				$output->pageSize = $documentos_midias->PageSize;
				$output->currentPage = $documentos_midias->CurrentPage;
			}
			else
			{
				// return all results
				$documentos_midias = $this->Phreezer->Query('documento_midia',$criteria);
				$output->rows = $documentos_midias->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single documento_midia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('documentationIddocumentation');
			$documento_midia = $this->Phreezer->Get('documento_midia',$pk);
			$this->RenderJSON($documento_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new documento_midia record and render response as JSON
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

			$documento_midia = new documento_midia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			$documento_midia->DocumentationIddocumentation = $this->SafeGetVal($json, 'documentationIddocumentation');
			$documento_midia->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia');

			$documento_midia->Validate();
			$errors = $documento_midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				// since the primary key is not auto-increment we must force the insert here
				$documento_midia->Save(true);
				$this->RenderJSON($documento_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing documento_midia record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('documentationIddocumentation');
			$documento_midia = $this->Phreezer->Get('documento_midia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $documento_midia->DocumentationIddocumentation = $this->SafeGetVal($json, 'documentationIddocumentation', $documento_midia->DocumentationIddocumentation);

			// this is a primary key.  uncomment if updating is allowed
			// $documento_midia->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia', $documento_midia->MediasIdmedia);


			$documento_midia->Validate();
			$errors = $documento_midia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$documento_midia->Save();
				$this->RenderJSON($documento_midia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
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
	 * API Method deletes an existing documento_midia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('documentationIddocumentation');
			$documento_midia = $this->Phreezer->Get('documento_midia',$pk);

			$documento_midia->Delete();

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
