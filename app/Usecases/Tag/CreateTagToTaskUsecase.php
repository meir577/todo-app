<?php

declare(strict_types=1);

namespace App\Usecases\Tag;

use App\Services\TagService;
use App\Usecases\Tag\Input\CreateTagToTaskUsecaseInput;
use App\Usecases\Tag\Output\CreateTagToTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CreateTagToTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TagService $taskService,
    )
    {
        parent::__construct(new Logger('CreateTagToTaskUsecase'));
    }

    /**
     * @property CreateTagToTaskUsecaseData $data
     * @property CreateTagToTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $taskId = $this->input->getTaskId();
            $data = $this->input->getData();
            $taskData = $this->taskService->create($taskId, $data);
            $this->data->setData($taskData);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new CreateTagToTaskUsecaseData();
    }
}
