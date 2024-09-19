<?php

namespace Tests\Feature;

use Illuminate\Contracts\Auth\Authenticatable;

class TaskControllerTest extends AbstractTestCase
{
    private Authenticatable $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->login();
    }

    public function test_index_executes_successfully(): void
    {
        // Arrange
        $accessToken = $this->login()->currentAccessToken();
        $project = $this->createProject($this->user);
        $tasks = [];
        for ($i = 1; $i <= 10; $i++) {
            $tasks[] = $this->createTask($project, $i)->toArray();
        }

        // Act
        $response = $this->getJson('/api/tasks', [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $this->assertDatabaseHas('tasks', $tasks);
    }

    public function test_storeTask_executes_successfully(): void
    {
        // Arrange
        $accessToken = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);

        $requestBody = [
            'name' => 'task #1',
            'project_id' => $project->id,
        ];

        // Act
        $response = $this->postJson('/api/tasks', $requestBody, [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $response->assertJsonFragment($requestBody);
        $this->assertDatabaseHas('tasks', $requestBody);
    }

    public function test_updateTask_executes_successfully(): void
    {
        // Arrange
        $accessToken = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $task = $this->createTask($project);
        $requestBody = [
            'completed' => !$task->completed,
        ];

        // Act
        $response = $this->putJson('/api/tasks/' . $task->id, $requestBody, [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $response->assertJsonFragment($requestBody);
        $this->assertNotEquals($response->json('data.completed'), $task->completed);
        $this->assertEquals($response->json('data.completed'), $requestBody['completed']);
    }

    public function test_deleteTask_executes_successfully(): void
    {
        // Arrange
        $accessToken = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $task = $this->createTask($project);

        // Act
        $response = $this->deleteJson('/api/tasks/' . $task->id, [
            'Authorization' => 'Bearer ' . $accessToken,
        ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
