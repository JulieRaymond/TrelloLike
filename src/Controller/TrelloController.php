<?php

namespace App\Controller;

use App\Model\TrelloManager;

class TrelloController extends AbstractController
{
    public function index()
    {
        $taskManager = new TrelloManager();

        if (isset($_POST['add_column'])) {
            $columnTitle = $_POST['column_title'];
            $taskManager->addColumn($columnTitle);
        }

        if (isset($_POST['add_task'])) {
            $columnIndex = $_POST['column_index'];
            $taskDescription = $_POST['task_description'];
            $taskManager->addTaskToColumn($columnIndex, $taskDescription);
        }

        if (isset($_POST['reset'])) {
            $taskManager->resetColumns();
        }

        if (isset($_POST['reset_task'])) {
            $columnIndex = $_POST['column_index'];
            $taskManager->resetTasksInColumn($columnIndex);
        }

        $columns = $taskManager->getColumns();

        return $this->twig->render('index.html.twig', ['columns' => $columns]);
    }
}
