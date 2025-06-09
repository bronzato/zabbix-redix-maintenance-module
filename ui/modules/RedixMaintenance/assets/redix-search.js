/**
 * Redix Search - Funcionalidade de busca avançada para o select de clientes
 */

class RedixSearch {
    constructor(selectElement) {
        this.select = selectElement;
        this.options = Array.from(selectElement.options);
        this.originalOptions = [...this.options];
        this.init();
    }

    init() {
        this.createSearchInput();
        this.bindEvents();
    }

    createSearchInput() {
        // Criar container para o input de busca
        const searchContainer = document.createElement('div');
        searchContainer.className = 'redix-search-container';
        searchContainer.style.cssText = `
            position: relative;
            margin-bottom: 5px;
        `;

        // Criar input de busca
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.className = 'redix-search-input';
        searchInput.placeholder = 'Digite para buscar cliente...';
        searchInput.style.cssText = `
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #e1e5e9;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        `;

        // Inserir antes do select
        this.select.parentNode.insertBefore(searchContainer, this.select);
        searchContainer.appendChild(searchInput);

        this.searchInput = searchInput;
    }

    bindEvents() {
        // Evento de busca
        this.searchInput.addEventListener('input', (e) => {
            this.filterOptions(e.target.value);
        });

        // Eventos de foco
        this.searchInput.addEventListener('focus', () => {
            this.searchInput.style.borderColor = '#0275d8';
            this.searchInput.style.boxShadow = '0 0 0 3px rgba(2, 117, 216, 0.1)';
        });

        this.searchInput.addEventListener('blur', () => {
            this.searchInput.style.borderColor = '#e1e5e9';
            this.searchInput.style.boxShadow = 'none';
        });

        // Limpar busca quando select muda
        this.select.addEventListener('change', () => {
            if (this.select.value !== '0') {
                const selectedOption = this.select.options[this.select.selectedIndex];
                this.searchInput.value = selectedOption.text;
            }
        });
    }

    filterOptions(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        
        // Limpar todas as opções
        this.select.innerHTML = '';
        
        // Adicionar opção padrão
        const defaultOption = document.createElement('option');
        defaultOption.value = '0';
        defaultOption.textContent = '-- Selecione um Cliente --';
        this.select.appendChild(defaultOption);

        // Filtrar e adicionar opções que correspondem à busca
        this.originalOptions.forEach(option => {
            if (option.value === '0') return; // Pular opção padrão
            
            if (option.textContent.toLowerCase().includes(term)) {
                const newOption = document.createElement('option');
                newOption.value = option.value;
                newOption.textContent = option.textContent;
                this.select.appendChild(newOption);
            }
        });

        // Se nenhuma opção foi encontrada, mostrar mensagem
        if (this.select.options.length === 1 && term.length > 0) {
            const noResultOption = document.createElement('option');
            noResultOption.value = '';
            noResultOption.textContent = 'Nenhum cliente encontrado';
            noResultOption.disabled = true;
            this.select.appendChild(noResultOption);
        }
    }

    // Método para resetar a busca
    reset() {
        this.searchInput.value = '';
        this.filterOptions('');
    }
}

// Inicializar automaticamente quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    const clienteSelect = document.getElementById('cliente_id');
    if (clienteSelect) {
        new RedixSearch(clienteSelect);
    }
});