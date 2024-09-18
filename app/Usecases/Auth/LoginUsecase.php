<?php

declare(strict_types=1);

namespace App\Usecases\Auth;

use App\Services\AuthService;
use App\Usecases\Auth\Input\LoginUsecaseInput;
use App\Usecases\Auth\Output\LoginUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class LoginUsecase extends BaseUsecase
{
    public function __construct(
        private readonly AuthService $authService,
    )
    {
        parent::__construct(new Logger('LoginUsecase'));
    }

    /**
     * @property LoginUsecaseData $data
     * @property LoginUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $credentials = $this->input->getCredentials();
            $tokenDto = $this->authService->attempt($credentials);
            $this->data->setData($tokenDto->toArray());
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), $ex->getCode());
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new LoginUsecaseData();
    }
}
