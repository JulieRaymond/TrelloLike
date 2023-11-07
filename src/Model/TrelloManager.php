<?php

namespace App\Model;

use PDO;

class TrelloManager
{
    public function getColumns()
    {
        return $_SESSION['columns'] ?? [];
    }

    public function addColumn($title)
    {
        $columns = $this->getColumns();
        $columns[] = [
            'title' => $title,
            'tasks' => [],
        ];
        $_SESSION['columns'] = $columns;
    }

    public function addTaskToColumn($columnIndex, $taskDescription)
    {
        $columns = $this->getColumns();
        if (isset($columns[$columnIndex])) {
            $columns[$columnIndex]['tasks'][] = $taskDescription;
            $_SESSION['columns'] = $columns;
        }
    }

    public function resetColumns()
    {
        unset($_SESSION['columns']);
    }

    public function resetTasksInColumn($columnIndex)
    {
        $columns = $this->getColumns();
        if (isset($columns[$columnIndex])) {
            $columns[$columnIndex]['tasks'] = [];
            $_SESSION['columns'] = $columns;
        }
    }
}
