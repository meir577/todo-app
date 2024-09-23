<?php

declare(strict_types=1);

namespace App\Usecases\Project;

use App\Domain\Project\Services\ProjectService;
use App\Usecases\Project\Input\GetProjectUsecaseInput;
use App\Usecases\Project\Output\GetProjectUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class GetProjectUsecase extends BaseUsecase
{
    public function __construct(
        private readonly ProjectService $project_service,
    )
    {
        parent::__construct(new Logger('GetProjectUsecase'));
    }

    /**
     * @property GetProjectUsecaseData $data
     * @property GetProjectUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $userId = $this->input->getUserId();
            $project_id = $this->input->getProjectId();
            $projects = $this->project_service->fetchAllProjects($userId, $project_id);
            $this->data->setData($projects);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new GetProjectUsecaseData();
    }
}
