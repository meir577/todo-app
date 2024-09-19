<?php

declare(strict_types=1);

namespace App\Usecases\Project;

use App\Services\ProjectService;
use App\Usecases\Project\Input\CreateProjectUsecaseInput;
use App\Usecases\Project\Output\CreateProjectUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CreateProjectUsecase extends BaseUsecase
{
    public function __construct(
        private readonly ProjectService $project_service,
    )
    {
        parent::__construct(new Logger('CreateProjectUsecase'));
    }

    /**
     * @property CreateProjectUsecaseData $data
     * @property CreateProjectUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $data = $this->input->getData();
            $project = $this->project_service->create($data);
            $this->data->setData($project);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new CreateProjectUsecaseData();
    }
}
