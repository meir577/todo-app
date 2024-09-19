<?php

declare(strict_types=1);

namespace App\Usecases\Task;

use App\Services\TaskService;
use App\Usecases\Task\Input\GetTaskUsecaseInput;
use App\Usecases\Task\Output\GetTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class GetTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TaskService $task_service,
    )
    {
        parent::__construct(new Logger('GetTaskUsecase'));
    }

    /**
     * @property GetTaskUsecaseData $data
     * @property GetTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $data = $this->input->getData();
            $tasks = $this->task_service->fetchTasks($data);
            $this->data->setData($tasks);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new GetTaskUsecaseData();
    }
}
