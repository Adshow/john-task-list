<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoutesTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $userData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('password'),
        ];
    }

    public function testCreateUser()
    {
        $response = $this->post(route('users.store'), $this->userData);

        $response->assertCreated();
        $this->assertDatabaseHas('users', ['email' => $this->userData['email']]);
    }

    public function testShowUser()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', ['id' => $user->id]));

        $response->assertOk()
            ->assertJson(['email' => $user->email]);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => 'newpassword',
        ];

        $response = $this->put(route('users.update', ['id' => $user->id]), $updatedData);

        $response->assertOk();
        $this->assertDatabaseHas('users', ['email' => $updatedData['email']]);
    }

    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', ['id' => $user->id]));

        $response->assertNoContent();

        $this->assertDatabaseMissing('users', ['email' => $user->email]);
    }
}