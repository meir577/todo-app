<?php

declare(strict_types=1);

namespace App\Usecases\Auth;

use App\Domain\User\Services\AuthService;
use App\Usecases\Auth\Input\LogoutUsecaseInput;
use App\Usecases\Auth\Output\LogoutUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class LogoutUsecase extends BaseUsecase
{
    public function __construct(
        private readonly AuthService $auth_service,
    )
    {
        parent::__construct(new Logger('LogoutUsecase'));
    }

    /**
     * @property LogoutUsecaseData $data
     * @property LogoutUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $this->auth_service->logout();
            $this->data->setData([]);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), $ex->getCode());
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new LogoutUsecaseData();
    }
}
