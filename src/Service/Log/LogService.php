<?php

namespace Orangesix\Service\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Orangesix\Service\ServiceBase;
use Orangesix\Repository\Log\LogRepository;

/**
 * Repository - LOG
 */
class LogService extends ServiceBase
{
    public function __construct(LogRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Realiza o disparo do LOG
     * @return void
     */
    public function dispatch(array $ignore = []): void
    {
        try {
            DB::connection(env('DB_CONNECTION', 'mysql'))->getPdo();

            if (Schema::hasTable(env('LOG_DB', 'log'))) {
                $this->log($ignore);
            }
        } catch (\Exception $exception) {
            return;
        }
    }

    /**
     * Realiza a validação dos dados LOG
     * @param Request $request
     * @return array
     */
    public function validated(Request $request): array
    {
        $data = $request->validate([
            'log_id_usuario' => '',
            'log_usuario' => '',
            'log_rota' => 'required',
            'log_ip' => 'required',
            'log_action' => 'required',
            'log_dados' => '',
        ]);

        $now = date('Y-m-d H:i');
        if ($this->repository->getModel()::query()
            ->where('log_id_usuario', '=', $data['log_id_usuario'])
            ->where('log_usuario', '=', $data['log_usuario'])
            ->where('log_rota', '=', $data['log_rota'])
            ->where('log_dados', '=', $data['log_dados'])
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') = '{$now}'")
            ->exists()) {
            throw new \Exception('Log já existe');
        }

        return $data;
    }

    /**
     * Realiza a gestão do LOG
     * @return void
     */
    private function log(array $ignore = []): void
    {
        $user = Auth::user();
        $dados = \request()->all();
        $rota = \request()->route()->getName();
        if (!in_array($rota, $ignore)) {
            $this->manager(new Request([
                'log_id_usuario' => $user?->id,
                'log_usuario' => $user?->nome,
                'log_rota' => \request()->route()->getName(),
                'log_ip' => \request()->ip(),
                'log_action' => \request()->method(),
                'log_dados' => empty($dados) || (isset($dados['iframe']) && $dados['iframe'] == '1') ? null : json_encode($dados)
            ]));
        }
    }
}
