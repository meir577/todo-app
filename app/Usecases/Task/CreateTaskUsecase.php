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
        private readonly TaskService $taskService,
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
            $taskData = $this->taskService->create($data);
            $this->data->setData($taskData);
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
