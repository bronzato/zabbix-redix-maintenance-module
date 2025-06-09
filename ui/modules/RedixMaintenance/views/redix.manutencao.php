<?php

$widget = (new CWidget())
    ->setTitle('Nova Manutenção Redix')
    ->addItem(
        (new CForm('post', (new CUrl('zabbix.php'))->setArgument('action', 'redix.manutencao')))
            ->setId('redix-maintenance-form')
            ->addItem(
                (new CFormGrid())
                    ->addItem([
                        new CLabel('Tipo de Manutenção', 'tipo_manutencao'),
                        new CFormField(
                            (new CDiv())
                                ->addClass('redix-radio-group')
                                ->addItem([
                                    (new CLabel())
                                        ->addClass('redix-radio-label')
                                        ->addItem([
                                            (new CInput('radio', 'tipo_manutencao', 'chamado'))
                                                ->setId('tipo_chamado')
                                                ->setChecked($data['form_data']['tipo_manutencao'] === 'chamado'),
                                            new CSpan('Chamado')
                                        ]),
                                    (new CLabel())
                                        ->addClass('redix-radio-label')
                                        ->addItem([
                                            (new CInput('radio', 'tipo_manutencao', 'projeto'))
                                                ->setId('tipo_projeto')
                                                ->setChecked($data['form_data']['tipo_manutencao'] === 'projeto'),
                                            new CSpan('Projeto')
                                        ])
                                ])
                        )
                    ])
                    ->addItem([
                        new CLabel('Número do Chamado', 'numero_chamado'),
                        new CFormField(
                            (new CTextBox('numero_chamado', $data['form_data']['numero_chamado']))
                                ->setId('numero_chamado')
                                ->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH)
                                ->setAttribute('placeholder', 'Ex: I-123456')
                                ->setAttribute('pattern', '^I-[0-9]+$')
                                ->setAttribute('title', 'Formato: I-123456')
                                ->setRequired(true)
                        )
                    ])
                    ->addItem([
                        new CLabel('Cliente', 'cliente_id'),
                        new CFormField(
                            (new CSelect('cliente_id'))
                                ->setId('cliente_id')
                                ->setValue($data['form_data']['cliente_id'])
                                ->addOption(new CSelectOption(0, '-- Selecione um Cliente --'))
                                ->addOptions(CSelect::createOptionsFromArray(
                                    zbx_toHash($data['hostgroups'], 'groupid', 'name')
                                ))
                                ->addClass('redix-select-cliente')
                                ->setAttribute('data-placeholder', 'Digite para buscar...')
                        )
                    ])
                    ->addItem([
                        new CLabel('Descrição do Problema', 'problema'),
                        new CFormField(
                            (new CTextArea('problema', $data['form_data']['problema']))
                                ->setId('problema')
                                ->setWidth(ZBX_TEXTAREA_STANDARD_WIDTH)
                                ->setMaxLength(100)
                                ->setAttribute('placeholder', 'Descreva o problema (máximo 100 caracteres)')
                                ->setAttribute('rows', 3)
                        )
                    ])
                    ->addItem([
                        new CFormField(
                            (new CDiv())
                                ->addClass('redix-form-actions')
                                ->addItem([
                                    (new CSubmit('submit', 'Continuar'))
                                        ->addClass('btn-alt-success'),
                                    (new CButton('cancel', 'Cancelar'))
                                        ->addClass('btn-alt-neutral')
                                        ->setAttribute('type', 'button')
                                ])
                        )
                    ])
            )
    );

// Incluir arquivo CSS customizado
$widget->addItem(
    (new CTag('link', false))
        ->setAttribute('rel', 'stylesheet')
        ->setAttribute('type', 'text/css')
        ->setAttribute('href', 'modules/RedixMaintenance/assets/redix-styles.css')
);

// Incluir arquivo JavaScript de busca
$widget->addItem(
    (new CTag('script', true))
        ->setAttribute('src', 'modules/RedixMaintenance/assets/redix-search.js')
);

// Adicionar JavaScript para funcionalidades interativas
$widget->addItem(
    (new CTag('script', true))
        ->addItem('
            document.addEventListener("DOMContentLoaded", function() {
                const tipoRadios = document.querySelectorAll("input[name=\'tipo_manutencao\']");
                const numeroChamadoField = document.getElementById("numero_chamado");
                const numeroChamadoLabel = numeroChamadoField.closest(".form-grid-row").querySelector("label");
                const problemaField = document.getElementById("problema");
                
                // Função para atualizar o label baseado no tipo selecionado
                function updateLabelAndValidation() {
                    const selectedType = document.querySelector("input[name=\'tipo_manutencao\']:checked").value;
                    
                    if (selectedType === "chamado") {
                        numeroChamadoLabel.textContent = "Número do Chamado";
                        numeroChamadoField.setAttribute("required", true);
                        numeroChamadoField.setAttribute("pattern", "^I-[0-9]+$");
                        numeroChamadoField.setAttribute("placeholder", "Ex: I-123456");
                    } else {
                        numeroChamadoLabel.textContent = "Número do Projeto";
                        numeroChamadoField.removeAttribute("required");
                        numeroChamadoField.removeAttribute("pattern");
                        numeroChamadoField.setAttribute("placeholder", "Ex: P-2024-001");
                    }
                }
                
                // Adicionar listeners aos radio buttons
                tipoRadios.forEach(radio => {
                    radio.addEventListener("change", updateLabelAndValidation);
                });
                
                // Validação do campo número do chamado
                numeroChamadoField.addEventListener("input", function() {
                    const selectedType = document.querySelector("input[name=\'tipo_manutencao\']:checked").value;
                    
                    if (selectedType === "chamado") {
                        const pattern = /^I-[0-9]+$/;
                        if (this.value && !pattern.test(this.value)) {
                            this.setCustomValidity("O número deve começar com I- seguido de números (ex: I-123456)");
                        } else {
                            this.setCustomValidity("");
                        }
                    }
                });
                
                // Contador de caracteres para o campo problema
                const counterDiv = document.createElement("div");
                counterDiv.className = "character-counter";
                counterDiv.textContent = "0/100 caracteres";
                problemaField.parentNode.appendChild(counterDiv);
                
                problemaField.addEventListener("input", function() {
                    const length = this.value.length;
                    counterDiv.textContent = length + "/100 caracteres";
                    
                    if (length > 90) {
                        counterDiv.style.color = "#dc3545";
                    } else if (length > 80) {
                        counterDiv.style.color = "#ffc107";
                    } else {
                        counterDiv.style.color = "#6c757d";
                    }
                });
                
                // Inicializar
                updateLabelAndValidation();
                
                // Botão cancelar
                document.querySelector("button[name=\'cancel\']").addEventListener("click", function() {
                    if (confirm("Tem certeza que deseja cancelar? Todos os dados serão perdidos.")) {
                        window.history.back();
                    }
                });
            });
        ')
);

$widget->show();