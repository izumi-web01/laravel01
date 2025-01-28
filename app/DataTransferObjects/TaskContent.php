<?php
namespace App\DataTransferObjects;

use DateTime;
use App\DataTransferObjects\Collections\TaskCollection;

class TaskContent {
    protected $taskName;
    protected $taskId;
    protected $status;
    protected $cdate;
    protected $udate;

    public function __construct(array $propaties = [])
    {
        foreach( $propaties as $key => $propaty ){
            $this->{ $key } = $propaty;
        };
    }

    public function getTaskName(){
        return $this->taskName;
    }
    public function getTaskId(){
        return $this->taskId;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getCdate() {
        $formatedCdate = new DateTime($this->cdate);
        $formatedCdate = $formatedCdate->format('Y/m/d');
        return $formatedCdate;
    }
    public function getUdate() {
        $formatedUdate = new DateTime($this->udate);
        $formatedUdate = $formatedUdate->format('Y/m/d');
        return $formatedUdate;
    }
}