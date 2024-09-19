<?php

declare(strict_types=1);

namespace App\Usecases\Auth;

use App\Services\AuthService;
use App\Usecases\Auth\Input\CurrentUserUsecaseInput;
use App\Usecases\Auth\Output\CurrentUserUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CurrentUserUsecase extends BaseUsecase
{
    public function __construct(
        private readonly AuthService $auth_service,
    )
    {
        parent::__construct(new Logger('CurrentUserUsecase'));
    }

    /**
     * @property CurrentUserUsecaseData $data
     * @property CurrentUserUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $user = $this->auth_service->getCurrentUser();
            $this->data->setData($user);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), $ex->getCode());
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new CurrentUserUsecaseData();
    }
}
