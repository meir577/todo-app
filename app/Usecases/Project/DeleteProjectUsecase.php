<?php

declare(strict_types=1);

namespace App\Usecases\Project;

use App\Services\ProjectService;
use App\Usecases\Project\Input\DeleteProjectUsecaseInput;
use App\Usecases\Project\Output\DeleteProjectUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class DeleteProjectUsecase extends BaseUsecase
{
    public function __construct(
        private readonly ProjectService $projectService,
    )
    {
        parent::__construct(new Logger('DeleteProjectUsecase'));
    }

    /**
     * @property DeleteProjectUsecaseData $data
     * @property DeleteProjectUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $project = $this->input->getProject();
            $this->projectService->remove($project);
            $this->data->setData([]);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new DeleteProjectUsecaseData();
    }
}
