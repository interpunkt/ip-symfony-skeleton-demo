<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160909225036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, dp_surname VARCHAR(255) DEFAULT NULL, dp_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, titel VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, sort VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_seo (id INT AUTO_INCREMENT NOT NULL, seo_titel VARCHAR(255) NOT NULL, seo_description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Imageupload (id INT AUTO_INCREMENT NOT NULL, imageName VARCHAR(255) NOT NULL, updatedAt DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `index` (id INT AUTO_INCREMENT NOT NULL, customId INT NOT NULL, x INT NOT NULL, y INT NOT NULL, width INT NOT NULL, height INT NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE less (id INT AUTO_INCREMENT NOT NULL, primary_color VARCHAR(255) NOT NULL, secondary_color VARCHAR(255) NOT NULL, primary_color_light VARCHAR(255) NOT NULL, secondary_color_dark VARCHAR(255) NOT NULL, highlight_success VARCHAR(255) NOT NULL, highlight_info VARCHAR(255) NOT NULL, highlight_notice VARCHAR(255) NOT NULL, highlight_error VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, text_color_class VARCHAR(255) NOT NULL, link_color VARCHAR(255) NOT NULL, link_color_hover VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE less_typographie (id INT AUTO_INCREMENT NOT NULL, h_one VARCHAR(255) NOT NULL, h_two VARCHAR(255) NOT NULL, h_three VARCHAR(255) NOT NULL, font_size VARCHAR(255) NOT NULL, font VARCHAR(255) NOT NULL, font_family VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, absender VARCHAR(255) NOT NULL, titel VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, sort LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter_recipient (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, email VARCHAR(255) NOT NULL, vorname VARCHAR(255) NOT NULL, nachname VARCHAR(255) NOT NULL, anrede VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C5BE71C9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, logopath VARCHAR(255) NOT NULL, primary_color VARCHAR(255) NOT NULL, secondary_color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ip_user_mail_settings (id INT AUTO_INCREMENT NOT NULL, newUserSender VARCHAR(255) NOT NULL, newUserSubject VARCHAR(255) NOT NULL, newUserContent TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ip_userSettings (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, repo VARCHAR(255) NOT NULL, ip_view TINYINT(1) NOT NULL, ip_edit TINYINT(1) NOT NULL, ip_delete TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dp_update (id INT AUTO_INCREMENT NOT NULL, version INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE blog_seo');
        $this->addSql('DROP TABLE Imageupload');
        $this->addSql('DROP TABLE `index`');
        $this->addSql('DROP TABLE less');
        $this->addSql('DROP TABLE less_typographie');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE newsletter_recipient');
        $this->addSql('DROP TABLE seo');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE ip_user_mail_settings');
        $this->addSql('DROP TABLE ip_userSettings');
        $this->addSql('DROP TABLE dp_update');
    }
}
