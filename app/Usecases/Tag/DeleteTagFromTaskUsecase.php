<?php

declare(strict_types=1);

namespace App\Usecases\Tag;

use App\Services\TagService;
use App\Usecases\Tag\Input\DeleteTagFromTaskUsecaseInput;
use App\Usecases\Tag\Output\DeleteTagFromTaskUsecaseData;
use MechtaMarket\PhpEnhance\Base\BaseUsecase;
use Monolog\Logger;

class DeleteTagFromTaskUsecase extends BaseUsecase
{
    public function __construct(
        private readonly TagService $tag_service,
    )
    {
        parent::__construct(new Logger('DeleteTagFromTaskUsecase'));
    }

    /**
     * @property DeleteTagFromTaskUsecaseData $data
     * @property DeleteTagFromTaskUsecaseInput $input
     */
    public function execute(): void
    {
        try {
            $data = $this->input->getData();
            $this->tag_service->remove($data);
            $this->data->setData([]);
        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new DeleteTagFromTaskUsecaseData();
    }
}
