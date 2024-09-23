<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Tag\Entity\Tag;
use App\Domain\Task\Entity\Task;
use App\Http\Requests\Tag\AddTagRequest;
use App\Usecases\Tag\CreateTagToTaskUsecase;
use App\Usecases\Tag\DeleteTagFromTaskUsecase;
use App\Usecases\Tag\Input\CreateTagToTaskUsecaseInput;
use App\Usecases\Tag\Input\DeleteTagFromTaskUsecaseInput;
use Illuminate\Http\JsonResponse;

class TagController extends AbstractController
{
    public function assignTag(AddTagRequest $add_tag_request, Task $task, CreateTagToTaskUsecase $assign_task_to_task_usecase): JsonResponse
    {
        $assign_tag_to_task_usecase_input = new CreateTagToTaskUsecaseInput($task, $add_tag_request->getData());

        $assign_task_to_task_usecase->setInput($assign_tag_to_task_usecase_input);

        $assign_task_to_task_usecase->execute();

        $response = $assign_task_to_task_usecase->getOutput();

        return $this->json($response);
    }

    public function removeTag(Tag $tag, DeleteTagFromTaskUsecase $remove_tag_from_task_usecase): JsonResponse
    {
        $remove_tag_from_task_usecase_input = new DeleteTagFromTaskUsecaseInput($tag);

        $remove_tag_from_task_usecase->setInput($remove_tag_from_task_usecase_input);

        $remove_tag_from_task_usecase->execute();

        $response = $remove_tag_from_task_usecase->getOutput();

        return $this->json($response);
    }
}
