<?php

namespace Tests\Feature;

use Illuminate\Contracts\Auth\Authenticatable;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends AbstractTestCase
{
    private Authenticatable $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->login();
    }

    public function test_index_returns_tasks_list(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $expected_task_count = 11;
        $this->createTask($project, $expected_task_count);

        // Act
        $response = $this->getJson('/api/tasks', [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $this->assertCount($expected_task_count, $response->json('data'));
    }

    public function test_show_givingValidId_returns_taskDetails(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $task = $this->createTask($project);

        // Act
        $response = $this->getJson('/api/tasks/' . $task->id, [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $this->assertEquals($response->json('data')[0], [
            'id' => $task->id,
            'name' => $task->name,
            'completed' => $task->completed,
            'project_id' => $task->project_id,
            'tags' => [],
        ]);
    }

    public function test_show_givingInValidId_returns_nothing(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $nonExistingTaskId = -1;

        // Act
        $response = $this->getJson('/api/tasks/' . $nonExistingTaskId, [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
    }

    public function test_store_givingTaskDetails_stores_task(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);

        $request_body = [
            'name' => 'task #1',
            'project_id' => $project->id,
        ];

        // Act
        $response = $this->postJson('/api/tasks', $request_body, [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $response->assertJsonFragment($request_body);
        $this->assertDatabaseHas('tasks', $request_body);
    }

    public function test_update_givingIdAndBody_updates_task(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $task = $this->createTask($project);
        $request_body = [
            'completed' => !$task->completed,
        ];

        // Act
        $response = $this->putJson('/api/tasks/' . $task->id, $request_body, [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $response->assertJsonFragment($request_body);
        $this->assertNotEquals($response->json('data.completed'), $task->completed);
        $this->assertEquals($response->json('data.completed'), $request_body['completed']);
    }

    public function test_delete_givingId_deletes_task(): void
    {
        // Arrange
        $access_token = $this->user->currentAccessToken();
        $project = $this->createProject($this->user);
        $task = $this->createTask($project);

        // Act
        $response = $this->deleteJson('/api/tasks/' . $task->id, [
            'Authorization' => 'Bearer ' . $access_token,
        ]);

        // Assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['result', 'errors', 'code', 'data']);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
