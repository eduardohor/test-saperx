<?php

namespace Tests\Feature\API;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_get_contacts_endpoint()
	{
		$contacts = Contact::factory(3)->create();

		$response = $this->getJson('/api/contacts');

		$response->assertStatus(200);
		$response->assertJsonCount(3);

		$response->assertJson(function (AssertableJson $json) use ($contacts) {
			$json->whereAllType([
				'0.id' => 'integer',
				'0.name' => 'string',
				'0.email' => 'string',
				'0.date_of_birth' => 'string',
				'0.telephone' => 'string',
			]);

			$json->hasAll(['0.id', '0.name', '0.email', '0.date_of_birth', '0.telephone']);

			$contact = $contacts->first();

			$json->whereAll([
				'0.id' => $contact->id,
				'0.name' => $contact->name,
				'0.email' => $contact->email,
				'0.date_of_birth' => $contact->date_of_birth,
				'0.telephone' => $contact->telephone,
			]);
		});
	}

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_get_single_contacts_endpoint()
	{
		$contact = Contact::factory(1)->createOne();

		$response = $this->getJson('/api/contacts/' . $contact->id);

		$response->assertStatus(200);

		$response->assertJson(function (AssertableJson $json) use ($contact) {
			$json->hasAll(['contact.id', 'contact.name', 'contact.email', 'contact.date_of_birth', 'contact.telephone']);

			$json->whereAllType([
				'contact.id' => 'integer',
				'contact.name' => 'string',
				'contact.email' => 'string',
				'contact.date_of_birth' => 'string',
				'contact.telephone' => 'string',
			]);

			$json->whereAll([
				'contact.id' => $contact->id,
				'contact.name' => $contact->name,
				'contact.email' => $contact->email,
				'contact.date_of_birth' => $contact->date_of_birth,
				'contact.telephone' => $contact->telephone,
			]);
		});
	}

	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_post_contacts_endpoint()
	{
		$contact = Contact::factory(1)->makeOne()->toArray();

		$response = $this->postJson('/api/contacts', $contact);

		$response->assertStatus(201);

		$response->assertJson(function (AssertableJson $json) use ($contact) {

			$json->hasAll(['contact.id', 'contact.name', 'contact.email', 'contact.date_of_birth', 'contact.telephone']);

			$json->whereAll([
				'contact.name' => $contact['name'],
				'contact.email' => $contact['email'],
				'contact.date_of_birth' => $contact['date_of_birth'],
				'contact.telephone' => $contact['telephone'],
			]);
		});
	}
}
