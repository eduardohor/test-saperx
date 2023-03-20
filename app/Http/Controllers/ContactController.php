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

	public function update(Request $request, $id)
	{
		if (!$contact = $this->contact->find($id)) {
			return response()->json(['message' => 'Contact not found!'], 404);
		}

		$this->validate($request, [
			'name' => 'required|min:5|max:100|string',
			'date_of_birth' => 'required|date',
			'cpf' => 'required|min:11|max:11',
			'telephone' => 'required'
		]);


		$contact->fill($request->all());

		if ($contact->isDirty('email')) {
			$this->validate($request, [
				'name' => 'required|min:5|max:100|string',
				'email' => 'required|email|unique:contacts',
				'date_of_birth' => 'required|date',
				'cpf' => 'required|min:11|max:11',
				'telephone' => 'required'
			]);
		}

		$contact->save();

		return response()->json(['message' => 'Contact updated successfully', 'contact' => $contact], 200);
	}
}
