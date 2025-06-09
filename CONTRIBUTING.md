# 🤝 Guia de Contribuição

Obrigado por considerar contribuir para o Módulo Redix Maintenance! 🎉

Este documento contém diretrizes para contribuir com o projeto. Seguindo essas diretrizes, você nos ajuda a manter um processo de desenvolvimento eficiente e organizado.

## 📁 Índice

- [Código de Conduta](#-código-de-conduta)
- [Como Posso Contribuir?](#-como-posso-contribuir)
- [Reportando Bugs](#-reportando-bugs)
- [Sugerindo Funcionalidades](#-sugerindo-funcionalidades)
- [Desenvolvimento](#-desenvolvimento)
- [Padrões de Código](#-padrões-de-código)
- [Processo de Pull Request](#-processo-de-pull-request)

## 📋 Código de Conduta

Este projeto adere ao Código de Conduta. Ao participar, espera-se que você mantenha este código. Por favor, reporte comportamentos inaceitáveis abrindo uma issue.

### Nossos Compromissos

- 🌍 Ser inclusivo e acolhedor
- 🤝 Respeitar diferentes pontos de vista
- 💬 Aceitar críticas construtivas graciosamente
- 🎆 Focar no que é melhor para a comunidade
- ❤️ Mostrar empatia com outros membros

## 🎆 Como Posso Contribuir?

### 🐛 Reportando Bugs

Antes de criar um bug report:

1. **Verifique se o bug já foi reportado** procurando nas [issues existentes](https://github.com/bronzato/zabbix-redix-maintenance-module/issues)
2. **Execute o script de diagnóstico**: `php scripts/check-module.php`
3. **Colete informações do sistema** (Zabbix, PHP, OS)
4. **Reproduza o bug** em um ambiente limpo

**Use o template de bug report** ao criar a issue:
- 📄 Descrição clara do problema
- 🔄 Passos para reproduzir
- ✅ Comportamento esperado vs real
- 💻 Informações do ambiente
- 📜 Logs relevantes

### ✨ Sugerindo Funcionalidades

Antes de sugerir uma funcionalidade:

1. **Verifique o [roadmap](README.md#roadmap)** para ver se já está planejada
2. **Procure por suggestions similares** nas issues
3. **Considere se a funcionalidade** beneficia a maioria dos usuários

**Use o template de feature request**:
- 🎨 Descrição detalhada
- 👥 Casos de uso
- 📈 Prioridade estimada
- 🛠️ Complexidade (se souber)

### 📝 Melhorando Documentação

- Corrigir erros de ortografia/gramática
- Melhorar clareza das instruções
- Adicionar exemplos
- Traduzir para outros idiomas
- Atualizar screenshots

## 🛠️ Desenvolvimento

### 💻 Configurando o Ambiente

1. **Fork o repositório**
   ```bash
   git clone https://github.com/SEU_USERNAME/zabbix-redix-maintenance-module.git
   cd zabbix-redix-maintenance-module
   ```

2. **Instale em ambiente de desenvolvimento**
   ```bash
   # Copie para o Zabbix de desenvolvimento
   sudo cp -r ui/modules/RedixMaintenance /var/www/html/zabbix-dev/ui/modules/
   
   # Configure permissões
   sudo chown -R www-data:www-data /var/www/html/zabbix-dev/ui/modules/RedixMaintenance
   ```

3. **Execute verificações**
   ```bash
   php scripts/check-module.php
   ```

### 🌿 Workflow de Desenvolvimento

1. **Crie uma branch para sua feature**
   ```bash
   git checkout -b feature/nova-funcionalidade
   # ou
   git checkout -b bugfix/correcao-bug
   ```

2. **Faça suas alterações**
   - Mantenha commits pequenos e focados
   - Use mensagens de commit descritivas
   - Teste suas alterações frequentemente

3. **Teste extensivamente**
   ```bash
   # Execute diagnósticos
   php scripts/check-module.php
   
   # Teste em diferentes navegadores
   # Teste funcionalidades existentes
   # Teste a nova funcionalidade
   ```

4. **Commit e push**
   ```bash
   git add .
   git commit -m "✨ Adiciona nova funcionalidade X"
   git push origin feature/nova-funcionalidade
   ```

## 📜 Padrões de Código

### PHP
- Use **PSR-12** para formatação
- **Documente** funções e classes complexas
- Use **type hints** quando possível
- **Valide** sempre inputs do usuário
- **Escape** outputs para prevenir XSS

```php
<?php

namespace Modules\RedixMaintenance\Actions;

use CController,
    CControllerResponseData;

/**
 * Controller para gerenciar manutenções
 */
class MinhaClasse extends CController
{
    /**
     * Método que faz algo importante
     * 
     * @param string $parametro Descrição do parâmetro
     * @return bool Retorna true em caso de sucesso
     */
    public function meuMetodo(string $parametro): bool
    {
        // Implementação
        return true;
    }
}
```

### JavaScript
- Use **ES6+** features quando possível
- **Comente** lógica complexa
- Use **const/let** em vez de var
- **Valide** dados antes de processar

```javascript
/**
 * Classe para gerenciar funcionalidade X
 */
class MinhaClasse {
    constructor(elemento) {
        this.elemento = elemento;
        this.init();
    }
    
    /**
     * Inicializa a funcionalidade
     */
    init() {
        // Implementação
    }
}
```

### CSS
- Use **BEM** methodology para naming
- **Prefixe** classes com 'redix-'
- Use **variáveis CSS** para cores/tamanhos
- **Comente** seções principais

```css
/* Componente principal */
.redix-component {
    /* Estilos base */
}

.redix-component__elemento {
    /* Elemento do componente */
}

.redix-component--modificador {
    /* Modificação do componente */
}
```

### Mensagens de Commit

Use [Conventional Commits](https://www.conventionalcommits.org/):

```bash
# Tipos
✨ feat: nova funcionalidade
🐛 fix: correção de bug
📄 docs: atualização de documentação
🎨 style: formatação, espaçamento
♾️ refactor: refatoração de código
⚡ perf: melhoria de performance
🧪 test: adição de testes
🔧 chore: tarefas de manutenção

# Exemplos
git commit -m "✨ feat: adiciona busca avançada de clientes"
git commit -m "🐛 fix: corrige validação de formato I-123456"
git commit -m "📄 docs: atualiza README com novas instruções"
```

## 🔄 Processo de Pull Request

### Antes de Submeter

- [ ] **Código** segue os padrões estabelecidos
- [ ] **Testes** passam (execute `php scripts/check-module.php`)
- [ ] **Documentação** foi atualizada se necessário
- [ ] **CHANGELOG.md** foi atualizado
- [ ] **Commits** estão bem organizados e com mensagens claras

### Template de PR

Use o template automático que inclui:

- 📝 Descrição das mudanças
- 🔗 Referência à issue relacionada
- 🔄 Tipo de mudança
- 🧪 Como foi testado
- 📷 Screenshots (se aplicável)
- ✅ Checklist de verificação

### Revisão

Seu PR será revisado por:

1. **Verificação automática** (se configurada)
2. **Revisão de código** por mantenedores
3. **Testes** em ambiente de desenvolvimento
4. **Validação** da funcionalidade

### Após Aprovação

- PR será **merged** para main
- **Tag** de versão criada (se necessário)
- **Release notes** atualizadas
- **Deploys** automáticos (se configurados)

## 🏆 Reconhecimento

Todos os contribuidores serão:

- 📜 **Listados** no arquivo CONTRIBUTORS.md
- 🏅 **Mencionados** nas release notes
- 💬 **Agradecidos** publicamente
- ⭐ **Convidados** a ser colaboradores (contribuições significativas)

## 📞 Suporte

Precisa de ajuda?

- 💬 **Discussões**: [GitHub Discussions](https://github.com/bronzato/zabbix-redix-maintenance-module/discussions)
- 🐛 **Bugs**: [Issues](https://github.com/bronzato/zabbix-redix-maintenance-module/issues)
- 📧 **Contato**: Crie uma issue com a tag "question"

---

🚀 **Obrigado por contribuir! Juntos podemos tornar este projeto ainda melhor!** 🎆