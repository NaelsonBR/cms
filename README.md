# base cms
# 
Esse projeto serve como base de programação para criar projetos em php, as funções que ele ja tem são:
-- sistema de login no painel adm pronto
---- endereço base_url/admin
---- login admin
---- senha 123
-- cadastro de noticias (posts) com categorias e tags, 
-- classe para receber mensagens de forms do site, guardar no banco e enviar por email
-- ja esta integrado com painel adminLTE
-- classe option onde pode ser guardado varios tipos de informação tipo links de redes sociais, dados de empresa, dados de configuração,
para serem editaveis pelo painel e exibidos no site com facilidade
-- classe para armazer logs no bd de tudo que acontecer de errado no php
-- classe para contar visualizações, cliques ou o que for necessario implementar no projeto
-- linguagem pt-br para as mensagens do sistema do codeigniter incluida e ativa

configurações para funcionar em localhost
-- subir no seu mysql a base que esta na raiz
--configurar a base url no application/config/config:26
--trocar a encryption key no application/config/config:327 (recomendado)
--configurar os dados dos bancos no model connect (o $con é chamado pela função estática desse model)

obs.:
-- Todos os models criados na pasta models serão carregados no autoload nativo do codeigniter por meio de uma gambiarra que
fiz no arquivo aplication/config/autoload
-- o model Helper é onde eu guardo todas as funções uteis, depois vamos tranforma-lo em um helper mesmo conforme o padrao do codeigniter
