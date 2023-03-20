<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	private $contact;

	public function __construct(Contact $contact)
	{
		$this->contact = $contact;
	}

  public function index()
	{
		return 'Index';
	}

	public function store(ContactRequest $request)
	{
		$dataRequest = $request->all();

		$contact = $this->contact->create($dataRequest);

		return response()->json(['contact' => $contact], 201);
		
	}
}
