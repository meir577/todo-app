<?php

declare(strict_types=1);

namespace App\Usecases\Auth;

use App\Services\AuthService;
use App\Usecases\Auth\Input\CurrentUserUsecaseInput;
use App\Usecases\Auth\Output\CurrentUserUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class CurrentUserUserCase extends BaseUsecase
{
    public function __construct(
        private readonly AuthService $authService,
    )
    {
        parent::__construct(new Logger('CurrentUserUserCase'));
    }

    /**
     * @property CurrentUserUsecaseData $data
     * @property CurrentUserUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $user = $this->authService->getCurrentUser();
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
