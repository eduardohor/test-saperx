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
		$contacts = $this->contact->orderByDesc('created_at')->get();

		return response()->json($contacts, 200);
	}

	public function store(ContactRequest $request)
	{
		$dataRequest = $request->all();

		$contact = $this->contact->create($dataRequest);

		return response()->json(['contact' => $contact], 201);
		
	}

	public function show($id)
	{
		if (!$contact = $this->contact->find($id)) {
			return response()->json(['message' => 'Contact not found!'], 404);
		}

		return response()->json(['contact' => $contact], 200);
	}
}
