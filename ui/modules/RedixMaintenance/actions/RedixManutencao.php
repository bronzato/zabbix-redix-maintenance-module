<?php

namespace Modules\RedixMaintenance\Actions;

use CController,
    CControllerResponseData,
    API,
    CRoleHelper;

class RedixManutencao extends CController {

    public function init(): void {
        $this->disableCsrfValidation();
    }

    protected function checkInput(): bool {
        $fields = [
            'tipo_manutencao' => 'string',
            'numero_chamado' => 'string',
            'cliente_id' => 'int32',
            'problema' => 'string'
        ];

        $ret = $this->validateInput($fields);

        if (!$ret) {
            $this->setResponse(new CControllerResponseFatal());
        }

        return $ret;
    }

    protected function checkPermissions(): bool {
        // Verificar se o usuário tem permissão para acessar hosts/hostgroups
        return CRoleHelper::checkAccess(CRoleHelper::UI_MONITORING_HOSTS);
    }

    protected function doAction(): void {
        // Carregar hostgroups para a lista de clientes
        try {
            $hostgroups = API::HostGroup()->get([
                'output' => ['groupid', 'name'],
                'sortfield' => 'name',
                'limit' => 1000
            ]);
        } catch (Exception $e) {
            // Fallback para dados estáticos em caso de erro
            $hostgroups = [
                ['groupid' => 1, 'name' => 'Zabbix servers'],
                ['groupid' => 2, 'name' => 'Linux servers'],
                ['groupid' => 3, 'name' => 'Windows servers']
            ];
        }

        // Preparar dados para a view
        $data = [
            'hostgroups' => $hostgroups,
            'form_data' => [
                'tipo_manutencao' => $this->getInput('tipo_manutencao', 'chamado'),
                'numero_chamado' => $this->getInput('numero_chamado', ''),
                'cliente_id' => $this->getInput('cliente_id', 0),
                'problema' => $this->getInput('problema', '')
            ]
        ];

        $response = new CControllerResponseData($data);
        $this->setResponse($response);
    }
}