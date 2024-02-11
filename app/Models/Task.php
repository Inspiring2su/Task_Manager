<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'deadline', 'status', 'user_id', 'project_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeFilterByStatus($query, $status)
    {
        if (!empty($status)) {
            $query->where('status', $status);
        }
    }

    public function scopeFilterByDueDate($query, $dueDate)
    {
        if (!empty($dueDate)) {
            $query->whereDate('deadline', $dueDate);
        }
    }

    public function scopeSortByField($query, $sortBy, $sortOrder = 'asc')
    {
        $allowedSortFields = ['deadline', 'name'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }
    }
}
