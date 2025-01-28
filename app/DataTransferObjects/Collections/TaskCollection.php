<?php
namespace App\DataTransferObjects\Collections;

use App\Task;
use App\DataTransferObjects\TaskContent;

class TaskCollection {
    public $tasks;

    public function __construct($tasks = [])
    {
        $this->tasks = $tasks;
    }

    public function toArray(){
        $collection = [];
        foreach( $this->tasks as $task ){
            $collection[] = new TaskContent([
                'taskName' => $task['name'],
                'taskId' => $task['id'],
                'status' => $task['status'],
                'cdate' => $task['created_at'],
                'udate' => $task['updated_at'],
            ]);
            
        }
        return $collection;
    }
}