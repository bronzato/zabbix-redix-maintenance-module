<?php

namespace Modules\RedixMaintenance;

use Zabbix\Core\CModule,
    APP,
    CMenuItem;

class Module extends CModule {

    public function init(): void {
        $menu = APP::Component()->get('menu.main');
        
        // Criar item de menu principal Redix
        $redixMenu = (new CMenuItem(_('Redix')))
            ->setId('redix-menu');
            
        // Adicionar submenu Manutenção
        $redixMenu->getSubmenu()
            ->add((new CMenuItem(_('Manutenção')))->setAction('redix.manutencao'));
            
        // Adicionar o menu principal
        $menu->add($redixMenu);
    }
}