#!/bin/bash

# Script de Instalação do Módulo Redix Maintenance
# Execute como root ou com sudo

set -e

echo "🚀 INSTALADOR MÓDULO REDIX MAINTENANCE"
echo "====================================="
echo ""

# Verificar se está rodando como root
if [[ $EUID -ne 0 ]]; then
   echo "❌ Este script deve ser executado como root (use sudo)"
   exit 1
fi

# Detectar diretório do Zabbix
ZABBIX_DIR=""
POSSIBLE_DIRS=(
    "/var/www/html/zabbix"
    "/usr/share/zabbix"
    "/var/www/zabbix"
    "/opt/zabbix/frontend"
)

echo "🔍 Procurando instalação do Zabbix..."
for dir in "${POSSIBLE_DIRS[@]}"; do
    if [[ -d "$dir/ui" && -f "$dir/index.php" ]]; then
        ZABBIX_DIR="$dir"
        echo "✅ Zabbix encontrado em: $ZABBIX_DIR"
        break
    fi
done

if [[ -z "$ZABBIX_DIR" ]]; then
    echo "❌ Instalação do Zabbix não encontrada!"
    echo "   Diretórios verificados: ${POSSIBLE_DIRS[*]}"
    echo "   Informe manualmente o caminho:"
    read -p "   Caminho do Zabbix: " ZABBIX_DIR
    
    if [[ ! -d "$ZABBIX_DIR/ui" ]]; then
        echo "❌ Diretório inválido: $ZABBIX_DIR"
        exit 1
    fi
fi

# Verificar se o diretório de módulos existe
MODULES_DIR="$ZABBIX_DIR/ui/modules"
if [[ ! -d "$MODULES_DIR" ]]; then
    echo "📁 Criando diretório de módulos: $MODULES_DIR"
    mkdir -p "$MODULES_DIR"
fi

# Verificar se já existe uma instalação
TARGET_DIR="$MODULES_DIR/RedixMaintenance"
if [[ -d "$TARGET_DIR" ]]; then
    echo "⚠️  Módulo já existe em: $TARGET_DIR"
    read -p "   Deseja sobrescrever? [y/N]: " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Instalação cancelada"
        exit 1
    fi
    echo "🗑️  Removendo instalação anterior..."
    rm -rf "$TARGET_DIR"
fi

# Copiar arquivos do módulo
echo "📦 Copiando arquivos do módulo..."
cp -r "ui/modules/RedixMaintenance" "$TARGET_DIR"

# Detectar usuário do servidor web
WEB_USER=""
if id "www-data" &>/dev/null; then
    WEB_USER="www-data"
elif id "nginx" &>/dev/null; then
    WEB_USER="nginx"
elif id "apache" &>/dev/null; then
    WEB_USER="apache"
else
    echo "⚠️  Usuário do servidor web não detectado automaticamente"
    read -p "   Informe o usuário (ex: www-data, nginx, apache): " WEB_USER
fi

echo "👤 Usuário do servidor web: $WEB_USER"

# Definir permissões
echo "🔒 Configurando permissões..."
chown -R "$WEB_USER:$WEB_USER" "$TARGET_DIR"
chmod -R 755 "$TARGET_DIR"
find "$TARGET_DIR" -type f -name "*.php" -exec chmod 644 {} \;
find "$TARGET_DIR" -type f -name "*.css" -exec chmod 644 {} \;
find "$TARGET_DIR" -type f -name "*.js" -exec chmod 644 {} \;
find "$TARGET_DIR" -type f -name "*.json" -exec chmod 644 {} \;

# Verificar instalação
echo "🔍 Verificando instalação..."
if [[ -f "$TARGET_DIR/manifest.json" && -f "$TARGET_DIR/Module.php" ]]; then
    echo "✅ Arquivos principais encontrados"
else
    echo "❌ Erro na instalação - arquivos principais não encontrados"
    exit 1
fi

# Executar verificação de sintaxe
echo "🔍 Verificando sintaxe PHP..."
php -l "$TARGET_DIR/Module.php" > /dev/null && echo "✅ Module.php - OK"
php -l "$TARGET_DIR/actions/RedixManutencao.php" > /dev/null && echo "✅ RedixManutencao.php - OK"

echo ""
echo "🎉 INSTALAÇÃO CONCLUÍDA COM SUCESSO!"
echo "===================================="
echo ""
echo "📋 PRÓXIMOS PASSOS:"
echo "1. Acesse o Zabbix frontend"
echo "2. Vá para Administration → General → Modules"
echo "3. Clique em 'Scan directory'"
echo "4. Habilite o módulo 'Redix Maintenance'"
echo "5. Acesse o menu Redix → Manutenção"
echo ""
echo "🔧 VERIFICAÇÃO:"
echo "   Execute: php $ZABBIX_DIR/scripts/check-module.php"
echo ""
echo "📁 Instalado em: $TARGET_DIR"
echo "👤 Proprietário: $WEB_USER"
echo ""
echo "📞 Suporte: https://github.com/bronzato/zabbix-redix-maintenance-module/issues"
