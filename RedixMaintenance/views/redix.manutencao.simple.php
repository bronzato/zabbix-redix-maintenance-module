<?php

// View simplificada para testes e debug
echo '<div style="padding: 20px; font-family: Arial, sans-serif;">';
echo '<h1 style="color: #28a745;">✅ MÓDULO REDIX FUNCIONANDO!</h1>';
echo '<div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 20px 0;">';
echo '<h3>Informações de Debug:</h3>';
echo '<p><strong>Timestamp:</strong> ' . date('Y-m-d H:i:s') . '</p>';
echo '<p><strong>Mensagem da Controller:</strong> ' . htmlspecialchars($data['message'] ?? 'Dados carregados com sucesso') . '</p>';
echo '<p><strong>Número de Clientes:</strong> ' . count($data['hostgroups'] ?? []) . '</p>';
if (!empty($data['hostgroups'])) {
    echo '<p><strong>Primeiros Clientes:</strong></p>';
    echo '<ul>';
    $count = 0;
    foreach ($data['hostgroups'] as $group) {
        if ($count >= 3) break;
        echo '<li>' . htmlspecialchars($group['name']) . ' (ID: ' . $group['groupid'] . ')</li>';
        $count++;
    }
    echo '</ul>';
}
echo '</div>';
echo '<p><a href="zabbix.php?action=module.list" style="color: #007bff;">← Voltar para Módulos</a></p>';
echo '</div>';