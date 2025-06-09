# Changelog

Todas as mudanças notáveis neste projeto serão documentadas neste arquivo.

O formato é baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/),
e este projeto adere ao [Versionamento Semântico](https://semver.org/lang/pt-BR/).

## [1.0.0] - 2025-06-09

### ✨ Adicionado
- Estrutura inicial do módulo para Zabbix 6.4+
- Menu "Redix" com submenu "Manutenção"
- Formulário de cadastro de manutenção com:
  - Seleção entre "Chamado" e "Projeto"
  - Campo de número com validação I-123456
  - Lista de clientes com busca em tempo real
  - Campo de problema com contador de caracteres (100 max)
- Interface moderna e responsiva
- Validação em tempo real
- Busca avançada na lista de clientes
- Contador dinâmico de caracteres
- Feedback visual para validações
- Animações e transições suaves
- Design responsivo para dispositivos móveis
- Scripts de diagnóstico e instalação
- Documentação completa

### 🛠️ Técnico
- Namespace: `Modules\RedixMaintenance`
- Action: `redix.manutencao`
- Controller: `RedixManutencao`
- Views: Principal, Simplificada e Teste
- Assets: CSS e JavaScript separados
- Integração com API do Zabbix para hostgroups
- Compatibilidade com Zabbix 6.4+
- Suporte a PHP 7.4+

### 📁 Arquivos
- `manifest.json` - Configuração do módulo
- `Module.php` - Classe principal
- `actions/RedixManutencao.php` - Controller
- `views/redix.manutencao.php` - View principal
- `views/redix.manutencao.simple.php` - View simplificada
- `views/redix.manutencao.test.php` - View de teste
- `assets/redix-styles.css` - Estilos customizados
- `assets/redix-search.js` - JavaScript de busca
- `scripts/check-module.php` - Script de diagnóstico
- `scripts/install.sh` - Script de instalação

### 🔮 Roadmap
- [ ] Configuração de horários de manutenção
- [ ] Seleção de hosts afetados
- [ ] Sistema de notificações
- [ ] Histórico de manutenções
- [ ] Relatórios de SLA
- [ ] Integração com API externa
- [ ] Templates de manutenção
- [ ] Aprovação de manutenções

---

## [Em Desenvolvimento]

### 🚧 Próxima Versão (1.1.0)
- Configuração de data/hora de início e fim
- Seleção de hosts/grupos afetados
- Pré-visualização da manutenção
- Gravação no banco de dados

### 🔮 Planejado (1.2.0)
- Histórico de manutenções
- Relatórios e estatísticas
- Notificações por email
- Templates reutilizáveis

### 🌌 Futuro (2.0.0)
- API REST completa
- Integração com sistemas externos
- Aprovação de manutenções
- Dashboard avançado
- Módulo mobile

---

**Legenda:**
- ✨ Adicionado: Novas funcionalidades
- 🔄 Alterado: Mudanças em funcionalidades existentes  
- 📝 Descontinuado: Funcionalidades que serão removidas
- ❌ Removido: Funcionalidades removidas
- 🔒 Segurança: Correções de vulnerabilidades
- 🐛 Corrigido: Correções de bugs