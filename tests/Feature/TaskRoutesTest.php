<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Database\Factories\UserFactory;
use Database\Factories\TaskFactory;

class TaskRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;
    private $taskData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskData = [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'attachment' => null,
            'completed' => false,
            'user_id' => $this->user->id,
        ];
    }

    public function testGetAllTasks()
    {
        Task::factory()->count(5)->create(['user_id' => $this->user->id]);

        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $responseData = $response->json();
        $this->assertCount(5, $responseData);
    }

    public function testCreateTask()
    {
        $response = $this->post(route('tasks.store'), $this->taskData);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', $this->taskData);
    }

    public function testShowTask()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('tasks.show', ['id' => $task->id]));

        $response->assertOk();
        $responseData = $response->json();
        $expectedData = $task->toArray();
        $this->assertEquals($expectedData, $responseData);
    }

    public function testUpdateTask()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $updatedData = [
            'title' => 'Updated Task Title',
            'description' => 'Updated Task Description',
            'completed' => true,
            'user_id' => $this->user->id,
        ];

        $response = $this->put(route('tasks.update', ['id' => $task->id]), $updatedData);

        $response->assertOk();
        $this->assertDatabaseHas('tasks', array_merge(['id' => $task->id], $updatedData));
    }

    public function testDeleteTask()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);

        $response = $this->delete(route('tasks.destroy', ['id' => $task->id]));

        $response->assertNoContent();

        $this->assertSoftDeleted('tasks', ['id' => $task->id]);
    }
}