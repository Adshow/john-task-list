<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class TaskService
{
    public function getAllTasks()
    {
        return Task::all();
    }

    public function createTask(array $data)
    {
        $attachmentPath = $data['attachment'] ? $this->saveAttachmentFile($data['attachment']) : null;

        $taskData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'attachment' => $attachmentPath,
            'completed' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => $data['user_id'],
        ];

        $task = Task::create($taskData);

        return $task;
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function updateTask(Task $task, array $data)
    {
        $task->fill($data);
        $task->updated_at = now();
        $task->save();

        return $task;
    }

    public function deleteTask(Task $task)
    {
        $this->deleteAttachmentFile($task->attachment);

        $task->delete();

        return true;
    }

    private function saveAttachmentFile($file)
    {
        $filename = $this->generateAttachmentFilename($file);
        $path = $this->storeAttachmentFile($file, $filename);

        return $path;
    }

    private function deleteAttachmentFile($path)
    {
        Storage::disk('public')->delete($path);
    }

    private function generateAttachmentFilename($file)
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    private function storeAttachmentFile($file, $filename)
    {
        return $file->storeAs('attachments', $filename, 'public');
    }
}