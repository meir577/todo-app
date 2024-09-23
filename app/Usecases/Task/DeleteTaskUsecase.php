<?php

declare(strict_types=1);

namespace App\Usecases\Task;

use App\Domain\Task\Services\TaskService;
use App\Usecases\Task\Input\DeleteTaskUsecaseInput;
use App\Usecases\Task\Output\DeleteTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class DeleteTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TaskService $task_service,
    )
    {
        parent::__construct(new Logger('DeleteTaskUsecase'));
    }

    /**
     * @property DeleteTaskUsecaseData $data
     * @property DeleteTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $task = $this->input->getTask();
            $deleted_task = $this->task_service->remove($task);
            $this->data->setData($deleted_task);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new DeleteTaskUsecaseData();
    }
}
