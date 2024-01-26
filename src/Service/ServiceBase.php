<?php

namespace Orangecode\Helpers\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Orangecode\Helpers\Repository\Repository;
use Orangecode\Helpers\Service\Response\ServiceResponse;

abstract class ServiceBase implements Service
{
    use ServiceDataBase;

    /** @var Repository */
    protected Repository $repository;

    /** @var ServiceResponse */
    protected ServiceResponse $response;

    /**
     * @param Repository $repository
     * @param ServiceResponse $response
     */
    public function __construct(Repository $repository, ServiceResponse $response)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * Realiza a pesquisa dos dados
     * @param int|null $id
     * @param array|null $where
     * @return Collection|Model|null
     */
    public function find(int $id = null): Collection | Model | null
    {
        return $this->repository->find($id);
    }

    /**
     * Realiza o cadastro ou atualização dos dados
     * @param Request $request
     * @return void
     */
    public function manager(Request $request): mixed
    {
        $data = $this->validated($request);
        try {
            return $this->repository->save($data);
        } catch (\Exception $exception) {
            if ($exception->getCode() == "23000")
                abort(400, "Erro no processamento do banco de dados. ({$exception->getMessage()})");
            abort(500, $exception->getMessage());
        }
    }

    /**
     * Realiza a exclusão dos dados
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        try {
            $this->repository->remove($request->id);
        } catch (\Exception $exception) {
            if ($exception->getCode() == "23000")
                abort(400, "Erro no processamento do banco de dados. ({$exception->getMessage()})");
            abort(500, $exception->getMessage());
        }
    }

    /**
     * Realiza a validação dos dados - OVERRIDE
     * @param Request $request
     * @return array
     */
    public function validated(Request $request): array
    {
        return [];
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->repository->getModel();
    }
}
