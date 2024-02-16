<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Models\Project;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_can_be_created()
    {
        $project = Project::factory()->create();
        
        $task = Task::factory()->create([
            'name' => 'create pages',
            'description' => 'create pages for ticket site',
            'deadline' => now()->addWeek()->toDateString(),
            'status' => 'pending',
            'project_id' => $project->id,
        ]);

        $this->assertEquals('create pages', $task->name);
        $this->assertEquals($project->id, $task->project_id);
        $this->assertModelExists($task);
    }

    /** @test */
    public function a_task_can_be_deleted()
    {
        $task = Task::factory()->create();
        $response = $this->delete('/tasks/' . $task->id);
        $this->assertCount(0, Task::all());
    }

    /** @test */
    public function a_task_is_associated_with_a_project()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);
        $this->assertEquals($task->project->id, $project->id);
    }

    /** @test */
    public function tasks_can_be_filtered_by_status()
    {
        $completedTask = Task::factory()->create(['status' => 'completed']);
        $pendingTask = Task::factory()->create(['status' => 'pending']);
        $response = $this->get('/tasks?status=pending');
        $response->assertSee($pendingTask->name)
                 ->assertDontSee($completedTask->name);
    }

    /** @test */
    public function tasks_can_be_sorted()
    {
        $taskA = Task::factory()->create(['name' => 'Task A', 'created_at' => now()->subDay()]);
        $taskB = Task::factory()->create(['name' => 'Task B', 'created_at' => now()]);
        $response = $this->get('/tasks?sort_by=name&sort_order=asc');
        $tasks = $response->viewData('tasks');
        $this->assertEquals('Task A', $tasks->first()->name);
    }
}

