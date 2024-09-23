<?php

declare(strict_types=1);

namespace App\Usecases\Tag;

use App\Domain\Tag\Services\TagService;
use App\Usecases\Tag\Input\CreateTagToTaskUsecaseInput;
use App\Usecases\Tag\Output\CreateTagToTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CreateTagToTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TagService $tag_service,
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
            $task_id = $this->input->getTaskId();
            $data = $this->input->getData();
            $task_data = $this->tag_service->create($task_id, $data);
            $this->data->setData($task_data);
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
