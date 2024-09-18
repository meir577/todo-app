<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Tag\AddTagRequest;
use App\Models\Tag;
use App\Models\Task;
use App\Usecases\Tag\CreateTagToTaskUsecase;
use App\Usecases\Tag\Input\CreateTagToTaskUsecaseInput;
use App\Usecases\Tag\Input\DeleteTagFromTaskUsecaseInput;
use App\Usecases\Tag\DeleteTagFromTaskUsecase;
use Illuminate\Http\JsonResponse;

class TagController extends AbstractController
{
    public function assignTag(AddTagRequest $addTagRequest, Task $task, CreateTagToTaskUsecase $assignTagToTaskUsecase): JsonResponse
    {
        $assignTagToTaskUsecaseInput = new CreateTagToTaskUsecaseInput($task, $addTagRequest->getData());

        $assignTagToTaskUsecase->setInput($assignTagToTaskUsecaseInput);

        $assignTagToTaskUsecase->execute();

        $response = $assignTagToTaskUsecase->getOutput();

        return $this->json($response);
    }

    public function removeTag(Tag $tag, DeleteTagFromTaskUsecase $removeTagFromTaskUsecase): JsonResponse
    {
        $removeTagFromTaskUsecaseInput = new DeleteTagFromTaskUsecaseInput($tag);

        $removeTagFromTaskUsecase->setInput($removeTagFromTaskUsecaseInput);

        $removeTagFromTaskUsecase->execute();

        $response = $removeTagFromTaskUsecase->getOutput();

        return $this->json($response);
    }
}
