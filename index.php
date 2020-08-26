<?php
	require_once 'config.php';
	require_once 'vendor/autoload.php';

	use Rafa\Adapters\PhpMailerAdapter;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////A PARTE QUE ESTÁ COMENTADA SERIA COMO FICARIA EM PRODUÇÃO(HOSPEDAGEM) ESSE SERVIÇO DE BACKUP////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Como executar num Cron Job? Ex abaixo:
	// 30 23 * * * php -f /home/site.com/15_BackupDBviaEmail/index.php (Executa todo dia as 23h30)

	shell_exec('C:\wamp64\bin\mysql\mysql5.7.26\bin\mysqldump -u root banco-blog > C:\wamp64\www\PROJS\VIDEO_AULAS\AULAS\15_BackupDBviaEmail\backup.sql');
	//shell_exec('mysqldump -u USUARIOMYSQL -pSENHA banco-blog > /home/site.com/PASTAQUEVCQUISER/backup.sql');

	$mail = new PhpMailerAdapter;
	$mail->setFrom('email@seudominio.com', 'Seu Nome');
	$mail->addAddress('seu_email_pessoal@xxx.com', 'Você');
	$mail->mountContent('Backup DB', 'Backup do Database');
	$mail->addAttachment('C:\wamp64\www\PROJS\VIDEO_AULAS\AULAS\15_BackupDBviaEmail\backup.sql');
	// $mail->addAttachment('/home/site.com/PASTAQUEVCQUISER/backup.sql');      (De preferência fora do 'public_html', conforme falei no vídeo)

	$mail->send();
	