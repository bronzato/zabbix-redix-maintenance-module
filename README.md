# Módulo Redix Maintenance para Zabbix

<div align="center">

![Zabbix](https://img.shields.io/badge/Zabbix-6.4%2B-red?style=flat&logo=zabbix)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue?style=flat&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)
![Version](https://img.shields.io/badge/Version-1.0-orange?style=flat)

**Sistema completo de gerenciamento de manutenções para Zabbix**

[📋 Funcionalidades](#funcionalidades) • [🚀 Instalação](#instalação) • [💻 Uso](#uso) • [🔧 Troubleshooting](#-troubleshooting)

</div>

---

## 🎯 Funcionalidades

### ✅ Primeira Parte - Informações Básicas

- **🔘 Tipo de Manutenção**: Radio button para selecionar entre "Chamado" e "Projeto"
- **📝 Número do Chamado/Projeto**: 
  - Para "Chamado": Campo obrigatório com validação (formato I-123456)
  - Para "Projeto": Campo opcional
- **👥 Cliente**: Lista suspensa com busca em tempo real, carregada dos hostgroups do Zabbix
- **📄 Problema**: Campo de texto com limite de 100 caracteres e contador dinâmico

### 🎨 Interface Moderna

- ✅ **Validação em tempo real** do formato I-123456
- ✅ **Contador de caracteres** dinâmico (0/100)
- ✅ **Integração com hostgroups** do Zabbix
- ✅ **Campos dinâmicos** baseados na seleção (Chamado/Projeto)
- ✅ **Feedback visual** para validação (cores verde/vermelho)
- ✅ **Busca avançada** na lista de clientes
- ✅ **Animações e transições** suaves
- ✅ **Design responsivo** para mobile
- ✅ **Tooltips informativos**
- ✅ **Confirmação ao cancelar**

---

## 🚀 Instalação

### 1️⃣ Download do Módulo

```bash
# Clonar o repositório
git clone https://github.com/bronzato/zabbix-redix-maintenance-module.git

# Ou baixar como ZIP
wget https://github.com/bronzato/zabbix-redix-maintenance-module/archive/main.zip
```

### 2️⃣ Instalação no Zabbix

```bash
# Copiar para o diretório de módulos do Zabbix
sudo cp -r zabbix-redix-maintenance-module/ui/modules/RedixMaintenance /var/www/html/zabbix/ui/modules/

# Definir permissões corretas
sudo chown -R www-data:www-data /var/www/html/zabbix/ui/modules/RedixMaintenance
sudo chmod -R 755 /var/www/html/zabbix/ui/modules/RedixMaintenance
```

### 3️⃣ Ativação no Frontend

1. Acesse o Zabbix frontend
2. Vá para **Administration → General → Modules**
3. Clique em **"Scan directory"** para detectar o novo módulo
4. Localize **"Redix Maintenance"** na lista
5. Clique em **"Disabled"** para habilitá-lo
6. O status mudará para **"Enabled"**

---

## 💻 Uso

### 🎮 Acessando o Módulo

1. No menu principal do Zabbix, clique em **Redix → Manutenção**
2. Preencha o formulário:
   - **Tipo**: Selecione "Chamado" ou "Projeto"
   - **Número**: Digite o número (obrigatório para chamados)
   - **Cliente**: Selecione da lista ou use a busca
   - **Problema**: Descreva o problema (máximo 100 caracteres)
3. Clique em **"Continuar"** para prosseguir ou **"Cancelar"** para voltar

### 🔍 Funcionalidades da Interface

#### Validação Dinâmica
- **Chamado**: Campo obrigatório com formato I-123456 (validação em tempo real)
- **Projeto**: Campo opcional sem validação específica
- Feedback visual com cores (verde para válido, vermelho para inválido)

#### Busca de Clientes
- Campo de busca acima da lista de clientes
- Filtragem em tempo real conforme você digita
- Exibe "Nenhum cliente encontrado" quando não há resultados

#### Contador de Caracteres
- Mostra contagem atual e limite (100 caracteres)
- Muda de cor conforme se aproxima do limite:
  - 🔘 **Cinza**: 0-80 caracteres
  - 🟡 **Amarelo**: 81-90 caracteres  
  - 🔴 **Vermelho**: 91-100 caracteres

#### Responsividade
- Layout adaptável para dispositivos móveis
- Botões empilhados em telas pequenas
- Radio buttons em coluna vertical no mobile

---

## 📁 Estrutura do Projeto

```
ui/modules/RedixMaintenance/
├── 📄 manifest.json                    # Configuração do módulo
├── 🐘 Module.php                       # Criação do menu
├── 📂 actions/
│   └── 🎯 RedixManutencao.php         # Lógica do controller
├── 📂 views/
│   ├── 🎨 redix.manutencao.php        # Interface completa
│   ├── 🔧 redix.manutencao.simple.php # Interface simplificada
│   └── 🧪 redix.manutencao.test.php   # Interface de teste
└── 📂 assets/
    ├── 🎨 redix-styles.css            # Estilos customizados
    └── 🔍 redix-search.js             # Funcionalidade de busca
```

---

## 🔧 Troubleshooting

### 🔍 Script de Diagnóstico

Se estiver com problemas, execute o script de verificação:

```bash
# Na pasta raiz do Zabbix
php check-module.php
```

### ❌ Problemas Comuns

| Problema | Causa | Solução |
|----------|-------|----------|
| **Erro 404** | Módulo não habilitado ou action não registrada | Desabilitar/reabilitar módulo |
| **Erro 500** | Erro de sintaxe PHP ou problema de namespace | Verificar logs PHP |
| **Menu não aparece** | Erro na estrutura do Module.php | Verificar sintaxe |
| **Permissões negadas** | Usuário sem permissões adequadas | Verificar perfil do usuário |

### 📊 Logs para Verificar

```bash
# Apache/Nginx
tail -f /var/log/apache2/error.log
tail -f /var/log/nginx/error.log

# PHP
tail -f /var/log/php/error.log

# Zabbix
tail -f /var/log/zabbix/zabbix_server.log
```

### 🛠️ Passos de Debug

1. **Execute o diagnóstico**: `php check-module.php`
2. **Verifique se todos os arquivos têm** ✅
3. **Desabilite e reabilite** o módulo
4. **Teste com a versão simplificada** primeiro
5. **Verifique permissões** dos arquivos
6. **Consulte os logs** em caso de erro

---

## 🛣️ Roadmap

### 🚧 Próximas Funcionalidades

- [ ] **Configuração de horários** de manutenção
- [ ] **Seleção de hosts** afetados
- [ ] **Sistema de notificações**
- [ ] **Histórico de manutenções**
- [ ] **Relatórios de SLA**
- [ ] **Integração com API** externa
- [ ] **Templates de manutenção**
- [ ] **Aprovação de manutenções**

---

## 🧰 Tecnologias Utilizadas

- **🐘 PHP**: Lógica do backend e integração com API do Zabbix
- **🌐 HTML**: Estrutura do formulário
- **🎨 CSS**: Estilização moderna e responsiva
- **⚡ JavaScript**: Interatividade e validações client-side
- **🔧 Zabbix API**: Integração com hostgroups e dados

---

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## 🤝 Contribuição

Contribuições são bem-vindas! Por favor:

1. 🍴 **Fork** o projeto
2. 🌿 **Crie uma branch** para sua feature (`git checkout -b feature/AmazingFeature`)
3. 💾 **Commit** suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. 📤 **Push** para a branch (`git push origin feature/AmazingFeature`)
5. 🔄 **Abra um Pull Request**

---

## 📞 Suporte

Se você encontrar algum problema ou tiver dúvidas:

- 🐛 **Reporte bugs**: [Issues](https://github.com/bronzato/zabbix-redix-maintenance-module/issues)
- 💡 **Sugira melhorias**: [Discussions](https://github.com/bronzato/zabbix-redix-maintenance-module/discussions)
- 📧 **Contato direto**: Abra uma issue

---

<div align="center">

**⭐ Se este projeto foi útil, considere dar uma estrela!**

**Desenvolvido com ❤️ para a comunidade Zabbix**

</div>