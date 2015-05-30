<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/local.php");

/**
 * localController is the controller class for the local object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class localController extends AppBaseController
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
	 * Displays a list view of local objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for local records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new localCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Complement,Latituded,Local,Longitude,Number,Otherinformation,Street,Type,Zipcode,City,Country,Institution,State'
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

				$locais = $this->Phreezer->Query('local',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $locais->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $locais->TotalResults;
				$output->totalPages = $locais->TotalPages;
				$output->pageSize = $locais->PageSize;
				$output->currentPage = $locais->CurrentPage;
			}
			else
			{
				// return all results
				$locais = $this->Phreezer->Query('local',$criteria);
				$output->rows = $locais->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single local record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$local = $this->Phreezer->Get('local',$pk);
			$this->RenderJSON($local, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new local record and render response as JSON
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

			$local = new local($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $local->Id = $this->SafeGetVal($json, 'id');

			$local->Complement = $this->SafeGetVal($json, 'complement');
			$local->Latituded = $this->SafeGetVal($json, 'latituded');
			$local->Local = $this->SafeGetVal($json, 'local');
			$local->Longitude = $this->SafeGetVal($json, 'longitude');
			$local->Number = $this->SafeGetVal($json, 'number');
			$local->Otherinformation = $this->SafeGetVal($json, 'otherinformation');
			$local->Street = $this->SafeGetVal($json, 'street');
			$local->Type = $this->SafeGetVal($json, 'type');
			$local->Zipcode = $this->SafeGetVal($json, 'zipcode');
			$local->City = $this->SafeGetVal($json, 'city');
			$local->Country = $this->SafeGetVal($json, 'country');
			$local->Institution = $this->SafeGetVal($json, 'institution');
			$local->State = $this->SafeGetVal($json, 'state');

			$local->Validate();
			$errors = $local->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$local->Save();
				$this->RenderJSON($local, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing local record and render response as JSON
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
			$local = $this->Phreezer->Get('local',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $local->Id = $this->SafeGetVal($json, 'id', $local->Id);

			$local->Complement = $this->SafeGetVal($json, 'complement', $local->Complement);
			$local->Latituded = $this->SafeGetVal($json, 'latituded', $local->Latituded);
			$local->Local = $this->SafeGetVal($json, 'local', $local->Local);
			$local->Longitude = $this->SafeGetVal($json, 'longitude', $local->Longitude);
			$local->Number = $this->SafeGetVal($json, 'number', $local->Number);
			$local->Otherinformation = $this->SafeGetVal($json, 'otherinformation', $local->Otherinformation);
			$local->Street = $this->SafeGetVal($json, 'street', $local->Street);
			$local->Type = $this->SafeGetVal($json, 'type', $local->Type);
			$local->Zipcode = $this->SafeGetVal($json, 'zipcode', $local->Zipcode);
			$local->City = $this->SafeGetVal($json, 'city', $local->City);
			$local->Country = $this->SafeGetVal($json, 'country', $local->Country);
			$local->Institution = $this->SafeGetVal($json, 'institution', $local->Institution);
			$local->State = $this->SafeGetVal($json, 'state', $local->State);

			$local->Validate();
			$errors = $local->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$local->Save();
				$this->RenderJSON($local, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing local record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$local = $this->Phreezer->Get('local',$pk);

			$local->Delete();

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
