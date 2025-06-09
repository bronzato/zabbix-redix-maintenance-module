<?php
/**
 * Verificação Específica do Módulo Redix
 * Execute este script na pasta raiz do Zabbix
 */

echo "🔍 VERIFICAÇÃO MÓDULO REDIX MAINTENANCE\n";
echo "=" . str_repeat("=", 50) . "\n\n";

$modulePath = 'ui/modules/RedixMaintenance';

// Estrutura esperada
$expectedFiles = [
    'manifest.json' => 'Configuração do módulo',
    'Module.php' => 'Classe principal do módulo',
    'actions/RedixManutencao.php' => 'Controller da action',
    'views/redix.manutencao.php' => 'View principal',
    'assets/redix-styles.css' => 'Estilos CSS',
    'assets/redix-search.js' => 'JavaScript de busca'
];

echo "1️⃣ VERIFICANDO ARQUIVOS:\n";
foreach ($expectedFiles as $file => $desc) {
    $fullPath = "$modulePath/$file";
    $status = file_exists($fullPath) ? "✅" : "❌";
    echo "   $status $file ($desc)\n";
    
    if (file_exists($fullPath)) {
        $size = filesize($fullPath);
        $perms = substr(sprintf('%o', fileperms($fullPath)), -4);
        echo "      📄 Tamanho: {$size} bytes | Permissões: $perms\n";
    }
}

echo "\n2️⃣ VERIFICANDO MANIFEST.JSON:\n";
$manifestPath = "$modulePath/manifest.json";
if (file_exists($manifestPath)) {
    $content = file_get_contents($manifestPath);
    $manifest = json_decode($content, true);
    
    if ($manifest) {
        echo "   ✅ JSON válido\n";
        echo "   📋 ID: " . ($manifest['id'] ?? 'N/A') . "\n";
        echo "   📋 Namespace: " . ($manifest['namespace'] ?? 'N/A') . "\n";
        
        if (isset($manifest['actions']['redix.manutencao'])) {
            $action = $manifest['actions']['redix.manutencao'];
            echo "   📋 Action Class: " . ($action['class'] ?? 'N/A') . "\n";
            echo "   📋 Action View: " . ($action['view'] ?? 'N/A') . "\n";
        } else {
            echo "   ❌ Action 'redix.manutencao' não encontrada\n";
        }
    } else {
        echo "   ❌ JSON inválido\n";
        echo "   🔍 Conteúdo: " . substr($content, 0, 200) . "...\n";
    }
}

echo "\n3️⃣ VERIFICANDO NAMESPACE NA ACTION:\n";
$actionPath = "$modulePath/actions/RedixManutencao.php";
if (file_exists($actionPath)) {
    $content = file_get_contents($actionPath);
    
    if (strpos($content, 'namespace Modules\\RedixMaintenance\\Actions;') !== false) {
        echo "   ✅ Namespace correto encontrado\n";
    } else {
        echo "   ❌ Namespace incorreto ou não encontrado\n";
    }
    
    if (strpos($content, 'class RedixManutencao extends CController') !== false) {
        echo "   ✅ Classe RedixManutencao encontrada\n";
    } else {
        echo "   ❌ Classe RedixManutencao não encontrada\n";
    }
} else {
    echo "   ❌ Arquivo de action não encontrado\n";
}

echo "\n4️⃣ VERIFICANDO VIEW:\n";
$viewPath = "$modulePath/views/redix.manutencao.php";
if (file_exists($viewPath)) {
    $content = file_get_contents($viewPath);
    $lines = count(explode("\n", $content));
    echo "   ✅ View encontrada ($lines linhas)\n";
    
    if (strpos($content, '\$widget') !== false) {
        echo "   ✅ Estrutura CWidget encontrada\n";
    } else {
        echo "   ⚠️  Estrutura CWidget não encontrada\n";
    }
} else {
    echo "   ❌ View não encontrada\n";
}

echo "\n5️⃣ VERIFICANDO SINTAXE PHP:\n";
$phpFiles = [
    'Module.php',
    'actions/RedixManutencao.php'
];

foreach ($phpFiles as $file) {
    $fullPath = "$modulePath/$file";
    if (file_exists($fullPath)) {
        $output = shell_exec("php -l $fullPath 2>&1");
        if (strpos($output, 'No syntax errors') !== false) {
            echo "   ✅ $file - Sintaxe OK\n";
        } else {
            echo "   ❌ $file - ERRO:\n";
            echo "      " . trim($output) . "\n";
        }
    }
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "🎯 PRÓXIMOS PASSOS:\n";
echo "1. Se todos os ✅, desabilite e reabilite o módulo\n";
echo "2. Acesse: Redix → Manutenção\n";
echo "3. Se erro 500, verifique logs PHP/Apache\n";
echo "4. Se 404, verifique se o módulo está habilitado\n";
echo "\n📊 LOGS ÚTEIS:\n";
echo "- Apache: tail -f /var/log/apache2/error.log\n";
echo "- Nginx: tail -f /var/log/nginx/error.log\n";
echo "- PHP: tail -f /var/log/php/error.log\n";
?>