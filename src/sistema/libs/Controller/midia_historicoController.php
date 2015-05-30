<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/midia_historico.php");

/**
 * midia_historicoController is the controller class for the midia_historico object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class midia_historicoController extends AppBaseController
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
	 * Displays a list view of midia_historico objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for midia_historico records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new midia_historicoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('HistoryIdhistory,MediasIdmedia'
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

				$midia_historicos = $this->Phreezer->Query('midia_historico',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $midia_historicos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $midia_historicos->TotalResults;
				$output->totalPages = $midia_historicos->TotalPages;
				$output->pageSize = $midia_historicos->PageSize;
				$output->currentPage = $midia_historicos->CurrentPage;
			}
			else
			{
				// return all results
				$midia_historicos = $this->Phreezer->Query('midia_historico',$criteria);
				$output->rows = $midia_historicos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single midia_historico record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('historyIdhistory');
			$midia_historico = $this->Phreezer->Get('midia_historico',$pk);
			$this->RenderJSON($midia_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new midia_historico record and render response as JSON
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

			$midia_historico = new midia_historico($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			$midia_historico->HistoryIdhistory = $this->SafeGetVal($json, 'historyIdhistory');
			$midia_historico->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia');

			$midia_historico->Validate();
			$errors = $midia_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				// since the primary key is not auto-increment we must force the insert here
				$midia_historico->Save(true);
				$this->RenderJSON($midia_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing midia_historico record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('historyIdhistory');
			$midia_historico = $this->Phreezer->Get('midia_historico',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $midia_historico->HistoryIdhistory = $this->SafeGetVal($json, 'historyIdhistory', $midia_historico->HistoryIdhistory);

			// this is a primary key.  uncomment if updating is allowed
			// $midia_historico->MediasIdmedia = $this->SafeGetVal($json, 'mediasIdmedia', $midia_historico->MediasIdmedia);


			$midia_historico->Validate();
			$errors = $midia_historico->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$midia_historico->Save();
				$this->RenderJSON($midia_historico, $this->JSONPCallback(), true, $this->SimpleObjectParams());
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
	 * API Method deletes an existing midia_historico record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('historyIdhistory');
			$midia_historico = $this->Phreezer->Get('midia_historico',$pk);

			$midia_historico->Delete();

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
