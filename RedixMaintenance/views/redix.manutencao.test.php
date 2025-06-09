<!DOCTYPE html>
<html>
<head>
    <title>Teste Redix Maintenance</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            padding: 20px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .success { 
            color: #28a745; 
            font-size: 2.5em; 
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .info { 
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px; 
            border-radius: 10px;
            border-left: 5px solid #007bff;
            margin: 20px 0;
        }
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .status-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            text-align: center;
        }
        .status-card.success { background: #d4edda; border-color: #c3e6cb; }
        .status-card.warning { background: #fff3cd; border-color: #ffeaa7; }
        .status-card.info { background: #d1ecf1; border-color: #bee5eb; }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 10px;
        }
        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="success">🎉 MÓDULO REDIX ATIVO!</h1>
        
        <div class="info">
            <h3>📈 Estatísticas do Sistema:</h3>
            <div class="status-grid">
                <div class="status-card success">
                    <h4>✅ Status</h4>
                    <p>Funcionando</p>
                </div>
                <div class="status-card info">
                    <h4>🕰️ Timestamp</h4>
                    <p><?php echo date('d/m/Y H:i:s'); ?></p>
                </div>
                <div class="status-card warning">
                    <h4>👥 Clientes</h4>
                    <p><?php echo count($data['hostgroups'] ?? []); ?> encontrados</p>
                </div>
                <div class="status-card info">
                    <h4>📄 Dados</h4>
                    <p><?php echo htmlspecialchars($data['message'] ?? 'Carregados'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="info">
            <h3>🔧 Informações Técnicas:</h3>
            <ul style="list-style: none; padding: 0;">
                <li><strong>📍 Namespace:</strong> Modules\RedixMaintenance\Actions</li>
                <li><strong>🎯 Action:</strong> redix.manutencao</li>
                <li><strong>📺 View:</strong> redix.manutencao.test</li>
                <li><strong>🔄 Versão:</strong> 1.0</li>
                <li><strong>🐘 PHP:</strong> <?php echo PHP_VERSION; ?></li>
            </ul>
        </div>
        
        <?php if (!empty($data['hostgroups'])): ?>
        <div class="info">
            <h3>📁 Primeiros Hostgroups Carregados:</h3>
            <ul>
                <?php 
                $count = 0;
                foreach ($data['hostgroups'] as $group): 
                    if ($count >= 5) break;
                ?>
                <li>🔗 <?php echo htmlspecialchars($group['name']); ?> (ID: <?php echo $group['groupid']; ?>)</li>
                <?php 
                    $count++;
                endforeach; 
                ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="zabbix.php?action=redix.manutencao" class="btn">📝 Acessar Formulário Completo</a>
            <a href="zabbix.php?action=module.list" class="btn">🔙 Voltar aos Módulos</a>
            <a href="zabbix.php" class="btn">🏠 Dashboard Principal</a>
        </div>
        
        <div class="footer">
            <p>🚀 <strong>Módulo Redix Maintenance</strong> - Desenvolvido para Zabbix</p>
            <p>📞 Suporte: <a href="https://github.com/bronzato/zabbix-redix-maintenance-module" target="_blank">GitHub</a></p>
        </div>
    </div>
</body>
</html>