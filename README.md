# Base CMS

Esse projeto serve como base de programação para criar projetos em php, as funções que ele ja tem são:

- sistema de login no painel adm pronto

- endereço: `http://base_url/admin`

*login:* admin
*senha:* 123

## Demais funcionalidades:

- cadastro de noticias (posts) com categorias e tags, 
- classe para receber mensagens de forms do site, guardar no banco e enviar por email
- ja esta integrado com painel adminLTE
- classe option onde pode ser guardado varios tipos de informação como:
    - tipo links de redes sociais
    - dados de empresa
    - dados de configuração

Esses dados podem ser editaveis pelo painel e exibidos no site com facilidade

- classe para armazer logs no bd de tudo que acontecer de errado no php
- classe para contar visualizações, cliques ou o que for necessario implementar no projeto
- linguagem pt-br para as mensagens do sistema do codeigniter incluida e ativa

## Instruções de Deploy

Configurações para funcionar em localhost
- subir no seu mysql a base que esta na raiz
- configurar a base_url em 

```
# Linha 26
application/config/config.php
```

- (Recomendado)trocar a encryption key em:

```
#linha 327
 application/config/config.php
```
 
- configurar os dados dos bancos no model connect (o `$con` é chamado pela função estática desse model)

### Informações adicionais :shipit:
- Todos os models criados na pasta models serão carregados no autoload nativo do codeigniter por meio de uma gambiarra que
fiz no arquivo `aplication/config/autoload.php`
- o model Helper é onde eu guardo todas as funções uteis, depois vamos tranforma-lo em um helper mesmo conforme o padrao do codeigniter
