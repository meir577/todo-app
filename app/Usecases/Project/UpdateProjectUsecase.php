<?php

declare(strict_types=1);

namespace App\Usecases\Project;

use App\Domain\Project\Services\ProjectService;
use App\Usecases\Project\Input\UpdateProjectUsecaseInput;
use App\Usecases\Project\Output\UpdateProjectUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class UpdateProjectUsecase extends BaseUsecase
{
    public function __construct(
        private readonly ProjectService $project_service,
    )
    {
        parent::__construct(new Logger('UpdateProjectUsecase'));
    }

    /**
     * @property UpdateProjectUsecaseData $data
     * @property UpdateProjectUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $project = $this->input->getProject();
            $data = $this->input->getData();
            $updatedData = $this->project_service->change($project, $data);
            $this->data->setData($updatedData);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new UpdateProjectUsecaseData();
    }
}
