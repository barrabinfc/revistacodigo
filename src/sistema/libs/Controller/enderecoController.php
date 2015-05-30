<?php
/** @package    sistema::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/endereco.php");

/**
 * enderecoController is the controller class for the endereco object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package sistema::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class enderecoController extends AppBaseController
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
	 * Displays a list view of endereco objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for endereco records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new enderecoCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Idaddress,City,Contact,Street,Number,Complement,Zipcode,Otherinformation'
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

				$enderecos = $this->Phreezer->Query('endereco',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $enderecos->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $enderecos->TotalResults;
				$output->totalPages = $enderecos->TotalPages;
				$output->pageSize = $enderecos->PageSize;
				$output->currentPage = $enderecos->CurrentPage;
			}
			else
			{
				// return all results
				$enderecos = $this->Phreezer->Query('endereco',$criteria);
				$output->rows = $enderecos->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single endereco record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('idaddress');
			$endereco = $this->Phreezer->Get('endereco',$pk);
			$this->RenderJSON($endereco, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new endereco record and render response as JSON
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

			$endereco = new endereco($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $endereco->Idaddress = $this->SafeGetVal($json, 'idaddress');

			$endereco->City = $this->SafeGetVal($json, 'city');
			$endereco->Contact = $this->SafeGetVal($json, 'contact');
			$endereco->Street = $this->SafeGetVal($json, 'street');
			$endereco->Number = $this->SafeGetVal($json, 'number');
			$endereco->Complement = $this->SafeGetVal($json, 'complement');
			$endereco->Zipcode = $this->SafeGetVal($json, 'zipcode');
			$endereco->Otherinformation = $this->SafeGetVal($json, 'otherinformation');

			$endereco->Validate();
			$errors = $endereco->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$endereco->Save();
				$this->RenderJSON($endereco, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing endereco record and render response as JSON
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

			$pk = $this->GetRouter()->GetUrlParam('idaddress');
			$endereco = $this->Phreezer->Get('endereco',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $endereco->Idaddress = $this->SafeGetVal($json, 'idaddress', $endereco->Idaddress);

			$endereco->City = $this->SafeGetVal($json, 'city', $endereco->City);
			$endereco->Contact = $this->SafeGetVal($json, 'contact', $endereco->Contact);
			$endereco->Street = $this->SafeGetVal($json, 'street', $endereco->Street);
			$endereco->Number = $this->SafeGetVal($json, 'number', $endereco->Number);
			$endereco->Complement = $this->SafeGetVal($json, 'complement', $endereco->Complement);
			$endereco->Zipcode = $this->SafeGetVal($json, 'zipcode', $endereco->Zipcode);
			$endereco->Otherinformation = $this->SafeGetVal($json, 'otherinformation', $endereco->Otherinformation);

			$endereco->Validate();
			$errors = $endereco->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$endereco->Save();
				$this->RenderJSON($endereco, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing endereco record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('idaddress');
			$endereco = $this->Phreezer->Get('endereco',$pk);

			$endereco->Delete();

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
