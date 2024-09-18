<?php

declare(strict_types=1);

namespace App\Usecases\Task;

use App\Services\TaskService;
use App\Usecases\Task\Input\UpdateTaskUsecaseInput;
use App\Usecases\Task\Output\UpdateTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class UpdateTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TaskService $taskService,
    )
    {
        parent::__construct(new Logger('UpdateTaskUsecase'));
    }

    /**
     * @property UpdateTaskUsecaseData $data
     * @property UpdateTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $task = $this->input->getTask();
            $data = $this->input->getData();
            $updatedData = $this->taskService->change($task, $data);
            $this->data->setData($updatedData);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new UpdateTaskUsecaseData();
    }
}
