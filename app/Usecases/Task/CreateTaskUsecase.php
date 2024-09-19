<?php

declare(strict_types=1);

namespace App\Usecases\Task;

use App\Services\TaskService;
use App\Usecases\Task\Input\CreateTaskUsecaseInput;
use App\Usecases\Task\Output\CreateTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CreateTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TaskService $task_service,
    )
    {
        parent::__construct(new Logger('CreateTaskUsecase'));
    }

    /**
     * @property CreateTaskUsecaseData $data
     * @property CreateTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $data = $this->input->getData();
            $task_data = $this->task_service->create($data);
            $this->data->setData($task_data);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new CreateTaskUsecaseData();
    }
}
