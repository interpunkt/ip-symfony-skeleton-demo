<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161123164830 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO `ip_user_mail_settings` (`id`, `newUserSender`, `newUserSubject`, `newUserContent`) VALUES(1, \'bk@inter-punkt.ch\', \'Betreff\', \'Inhalt\');');

        // Accounts Ben, Selim, Daniel im Fos User
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `dp_surname`, `dp_name`) VALUES (0, \'benblub\', \'benblub\', \'bk@inter-punkt.ch\', \'bk@inter-punkt.ch\', 1, \'nhz66bw29g0cskcowwgswgwo0k0408s\', \'$2y$13$nhz66bw29g0cskcowwgsweQri3viz3ZXTb8cI7IZtVpflKtRaXj.G\', NULL, 0, 0, NULL, NULL, NULL, \'a:2:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:15:"ROLE_INTERPUNKT";}\', 0, NULL, NULL, NULL);');
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `dp_surname`, `dp_name`) VALUES (0, \'daniel\', \'daniel\', \'daniel.lehrner@inter-punkt.ch\', \'daniel.lehrner@inter-punkt.ch\', 1, \'7d824c3t988wgc0wcckk4kgg8g48wwk\', \'$2y$13$7d824c3t988wgc0wcckk4eonmxKBw91F.nhNt8XbUushECmJA.uby\', \'2016-11-21 14:06:06\', 0, 0, NULL, NULL, NULL, \'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}\', 0, NULL, NULL, NULL);');
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `dp_surname`, `dp_name`) VALUES (0, \'selim\',\'selim\',\'si@inter-punkt.ch\',\'si@inter-punkt.ch\',1,\'453hjs1uri044wcgcogo4ksk4c00cws\',\'$2y$13$453hjs1uri044wcgcogo4ejbkIT0e9yHs53596WFoeX68FDI/uiLu\',\'2016-10-31 16:50:13\',0,0,NULL,NULL,NULL,\'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}\',0,NULL,NULL,NULL);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
