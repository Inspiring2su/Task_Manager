<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_can_be_created()
    {
        $task = Task::factory()->create();

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }
    /** @test */
    public function a_task_can_be_deleted()
    {
        $task = Task::factory()->create();
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    
        $task->delete();
    
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
    /** @test */
    public function a_task_is_associated_with_a_project()
    {
        $project = Project::factory()->create();
        $task = Task::factory()->create(['project_id' => $project->id]);
    
        $this->assertEquals($project->id, $task->project->id);
    }
    /** @test */
public function tasks_can_be_filtered_by_status()
{
    $completedTask = Task::factory()->create(['status' => 'completed']);
    $pendingTask = Task::factory()->create(['status' => 'pending']);
    
    $completedTasks = Task::query()->where('status', 'completed')->get();
    
    $this->assertTrue($completedTasks->contains($completedTask));
    $this->assertFalse($completedTasks->contains($pendingTask));
}
/** @test */
public function tasks_can_be_sorted_by_deadline()
{
    $task1 = Task::factory()->create(['deadline' => now()->addDay()]);
    $task2 = Task::factory()->create(['deadline' => now()->addWeek()]);
    
    $tasks = Task::query()->orderBy('deadline', 'asc')->get();
    
    $this->assertEquals($task1->id, $tasks->first()->id);
    $this->assertEquals($task2->id, $tasks->last()->id);
}

  
}
