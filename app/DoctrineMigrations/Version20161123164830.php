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
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `dp_surname`, `dp_name`) VALUES (0, \'benblub\', \'benblub\', \'bk@inter-punkt.ch\', \'bk@inter-punkt.ch\', 1, \'nhz66bw29g0cskcowwgswgwo0k0408s\', \'$2y$13$nhz66bw29g0cskcowwgsweQri3viz3ZXTb8cI7IZtVpflKtRaXj.G\', NULL, NULL, NULL, \'a:2:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:15:"ROLE_INTERPUNKT";}\', NULL, NULL);');
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `dp_surname`, `dp_name`) VALUES (0, \'daniel\', \'daniel\', \'daniel.lehrner@inter-punkt.ch\', \'daniel.lehrner@inter-punkt.ch\', 1, \'7d824c3t988wgc0wcckk4kgg8g48wwk\', \'$2y$13$7d824c3t988wgc0wcckk4eonmxKBw91F.nhNt8XbUushECmJA.uby\', NULL, NULL, NULL, \'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}\', NULL, NULL);');
        $this->addSql('INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `dp_surname`, `dp_name`) VALUES (0, \'selim\',\'selim\',\'si@inter-punkt.ch\',\'si@inter-punkt.ch\',1,\'453hjs1uri044wcgcogo4ksk4c00cws\',\'$2y$13$453hjs1uri044wcgcogo4ejbkIT0e9yHs53596WFoeX68FDI/uiLu\',NULL,NULL,NULL,\'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}\',NULL,NULL);');

        // Skeleton Updater
        $this->addSql('INSERT INTO `dp_update` (`id`, `version`) VALUES(1, 1);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
