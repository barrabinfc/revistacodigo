<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/creator_award_honour.php");

/**
 * creator_award_honourController is the controller class for the creator_award_honour object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class creator_award_honourController extends AppBaseController
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
	 * Displays a list view of creator_award_honour objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for creator_award_honour records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new creator_award_honourCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Description,Grantedby,Title,Type,Creator'
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

				$creator_award_honours = $this->Phreezer->Query('creator_award_honour',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $creator_award_honours->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $creator_award_honours->TotalResults;
				$output->totalPages = $creator_award_honours->TotalPages;
				$output->pageSize = $creator_award_honours->PageSize;
				$output->currentPage = $creator_award_honours->CurrentPage;
			}
			else
			{
				// return all results
				$creator_award_honours = $this->Phreezer->Query('creator_award_honour',$criteria);
				$output->rows = $creator_award_honours->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single creator_award_honour record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$creator_award_honour = $this->Phreezer->Get('creator_award_honour',$pk);
			$this->RenderJSON($creator_award_honour, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new creator_award_honour record and render response as JSON
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

			$creator_award_honour = new creator_award_honour($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $creator_award_honour->Id = $this->SafeGetVal($json, 'id');

			$creator_award_honour->Description = $this->SafeGetVal($json, 'description');
			$creator_award_honour->Grantedby = $this->SafeGetVal($json, 'grantedby');
			$creator_award_honour->Title = $this->SafeGetVal($json, 'title');
			$creator_award_honour->Type = $this->SafeGetVal($json, 'type');
			$creator_award_honour->Creator = $this->SafeGetVal($json, 'creator');

			$creator_award_honour->Validate();
			$errors = $creator_award_honour->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$creator_award_honour->Save();
				$this->RenderJSON($creator_award_honour, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing creator_award_honour record and render response as JSON
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
			$creator_award_honour = $this->Phreezer->Get('creator_award_honour',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $creator_award_honour->Id = $this->SafeGetVal($json, 'id', $creator_award_honour->Id);

			$creator_award_honour->Description = $this->SafeGetVal($json, 'description', $creator_award_honour->Description);
			$creator_award_honour->Grantedby = $this->SafeGetVal($json, 'grantedby', $creator_award_honour->Grantedby);
			$creator_award_honour->Title = $this->SafeGetVal($json, 'title', $creator_award_honour->Title);
			$creator_award_honour->Type = $this->SafeGetVal($json, 'type', $creator_award_honour->Type);
			$creator_award_honour->Creator = $this->SafeGetVal($json, 'creator', $creator_award_honour->Creator);

			$creator_award_honour->Validate();
			$errors = $creator_award_honour->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$creator_award_honour->Save();
				$this->RenderJSON($creator_award_honour, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing creator_award_honour record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$creator_award_honour = $this->Phreezer->Get('creator_award_honour',$pk);

			$creator_award_honour->Delete();

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
