<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/referencia.php");

/**
 * referenciaController is the controller class for the referencia object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class referenciaController extends AppBaseController
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
	 * Displays a list view of referencia objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for referencia records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new referenciaCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idreference,Item,Institution,Creator,Referencetype,Referencetitle,Referencedescription,Referenceauthor,Referencetext,Otherinformations'
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

				$referencias = $this->Phreezer->Query('referencia',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $referencias->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $referencias->TotalResults;
				$output->totalPages = $referencias->TotalPages;
				$output->pageSize = $referencias->PageSize;
				$output->currentPage = $referencias->CurrentPage;
			}
			else
			{
				// return all results
				$referencias = $this->Phreezer->Query('referencia',$criteria);
				$output->rows = $referencias->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single referencia record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idreference');
			$referencia = $this->Phreezer->Get('referencia',$pk);
			$this->RenderJSON($referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new referencia record and render response as JSON
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

			$referencia = new referencia($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $referencia->Idreference = $this->SafeGetVal($json, 'idreference');

			$referencia->Item = $this->SafeGetVal($json, 'item');
			$referencia->Institution = $this->SafeGetVal($json, 'institution');
			$referencia->Creator = $this->SafeGetVal($json, 'creator');
			$referencia->Referencetype = $this->SafeGetVal($json, 'referencetype');
			$referencia->Referencetitle = $this->SafeGetVal($json, 'referencetitle');
			$referencia->Referencedescription = $this->SafeGetVal($json, 'referencedescription');
			$referencia->Referenceauthor = $this->SafeGetVal($json, 'referenceauthor');
			$referencia->Referencetext = $this->SafeGetVal($json, 'referencetext');
			$referencia->Otherinformations = $this->SafeGetVal($json, 'otherinformations');

			$referencia->Validate();
			$errors = $referencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia->Save();
				$this->RenderJSON($referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing referencia record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idreference');
			$referencia = $this->Phreezer->Get('referencia',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $referencia->Idreference = $this->SafeGetVal($json, 'idreference', $referencia->Idreference);

			$referencia->Item = $this->SafeGetVal($json, 'item', $referencia->Item);
			$referencia->Institution = $this->SafeGetVal($json, 'institution', $referencia->Institution);
			$referencia->Creator = $this->SafeGetVal($json, 'creator', $referencia->Creator);
			$referencia->Referencetype = $this->SafeGetVal($json, 'referencetype', $referencia->Referencetype);
			$referencia->Referencetitle = $this->SafeGetVal($json, 'referencetitle', $referencia->Referencetitle);
			$referencia->Referencedescription = $this->SafeGetVal($json, 'referencedescription', $referencia->Referencedescription);
			$referencia->Referenceauthor = $this->SafeGetVal($json, 'referenceauthor', $referencia->Referenceauthor);
			$referencia->Referencetext = $this->SafeGetVal($json, 'referencetext', $referencia->Referencetext);
			$referencia->Otherinformations = $this->SafeGetVal($json, 'otherinformations', $referencia->Otherinformations);

			$referencia->Validate();
			$errors = $referencia->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$referencia->Save();
				$this->RenderJSON($referencia, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing referencia record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idreference');
			$referencia = $this->Phreezer->Get('referencia',$pk);

			$referencia->Delete();

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
