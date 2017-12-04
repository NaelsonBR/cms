<h3>Modo de manutenção</h3>
<p class='text-danger'>
	Se o modo de manutenção for ativado todos os visitantes do seu site verão apenas uma 
	tela avisando que o site encontra-se em manutenção.
</p>
<?php if ($ativo): ?>
	<h4>Status atual do site: <b><span class="text-danger">Modo de manutenção ativado !!!</span></b></h4>
	<a href="<?= base_url('dashboard/desativar_modo_manutencao') ?>" style="font-size: 40pt" title="desativar modo de manutenção">
		OFF <i class="fa fa-toggle-on" aria-hidden="true"></i> ON
	</a>
<?php else: ?>
	<h4>Status atual do site: <b><span class="text-success">Modo de manutenção desativado</span></b></h4>
	<a href="<?= base_url('dashboard/ativar_modo_manutencao') ?>" id='ativar_modo_manutencao' style="font-size: 40pt"
		 title="Ativar modo de manutenção">
		 OFF <i class="fa fa-toggle-off" aria-hidden="true"></i> ON
	</a>
<?php endif; ?>