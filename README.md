# Reiniciar VM automaticamente com Mikrotik 🚀

## Objetivo 🎯

É frustrante quando uma VM principal que roda um sistema importante trava, e precisamos acessar manualmente o servidor para reiniciá-la. Pensando em resolver esse problema, tive a ideia de usar o Mikrotik para acessar o servidor via SSH. No entanto, mesmo com um script de acesso, era necessário digitar a senha do servidor manualmente, pois o Mikrotik não tinha uma chave privada/pública compatível com outra máquina.

Para resumir, é possível acessar o Mikrotik via SSH sem senha a partir de um computador e acessar o Mikrotik com Mikrotik sem senha, mas não é possível acessar qualquer outra máquina sem senha com o Mikrotik. Contudo, o Mikrotik pode fazer acesso de URL com a ferramenta `tool/fetch url`. Então, criei um script em PHP que acessa qualquer host com usuário e senha configurados e envia qualquer comando. Dessa forma, no monitoramento do Mikrotik via netwatch, caso o IP da VM pare de responder e fique com status DOWN, ele executará o script configurado com `tool/fetch url`, acessando a página que está configurada para reiniciar a VM, que por sua vez reinicia a VM e volta a ficar UP.

## Requisitos 📝

- Máquina virtual com Ubuntu 22.xx ou 24.xx
- Roteador com RouterOS
- IP fixo

## 1ª Etapa: Configuração da Máquina Virtual 🖥️

1. Crie a máquina virtual ou use uma já instalada.
2. Configure o IP fixo na placa de rede.
3. Com a máquina funcionando, trabalhe com o usuário root:
   ```bash
   sudo su
   ```
   E digite a sua senha.

4. Instale os softwares necessários com os comandos abaixo:
   ```bash
   sudo apt-get update
   sudo apt install apache2
   sudo apt install php
   sudo apt-get install php-ssh2
   ```

5. Navegue até a seguinte pasta:
   ```bash
   cd /etc/php/x.x/cli/
   ```

6. Edite o arquivo `php.ini` e adicione a linha:
   ```bash
   nano php.ini
   ```
   Adicione:
   ```ini
   extension=ssh2.so
   ```

7. Reinicie o serviço web:
   ```bash
   sudo systemctl restart apache2
   ```

## 2ª Etapa: Criação do Script PHP 📜

1. Navegue até a pasta:
   ```bash
   cd /var/www/html/
   ```

2. Crie um arquivo PHP:
   ```bash
   nano php.php
   ```
   Escreva o seguinte código:
   ```php
   <?php
   phpinfo();
   ?>
   ```

## 3ª Etapa: Verificação ✅

1. Acesse `http://ipdavm/php.php`.
2. Se tudo ocorrer bem, a página abrirá. Procure por `ssh2`. Se estiver na página, significa que tudo foi instalado corretamente.
