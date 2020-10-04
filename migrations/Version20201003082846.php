<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003082846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, rtl TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entry CHANGE name name VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456FBA364942');
        $this->addSql('DROP INDEX IDX_B469456FBA364942 ON translation');
        $this->addSql('ALTER TABLE translation DROP language, CHANGE translation translation LONGTEXT NOT NULL, CHANGE entry_id language_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_B469456F82F1BAF4 ON translation (language_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation DROP FOREIGN KEY FK_B469456F82F1BAF4');
        $this->addSql('DROP TABLE language');
        $this->addSql('ALTER TABLE entry CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_B469456F82F1BAF4 ON translation');
        $this->addSql('ALTER TABLE translation ADD language VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE translation translation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE language_id entry_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE translation ADD CONSTRAINT FK_B469456FBA364942 FOREIGN KEY (entry_id) REFERENCES entry (id)');
        $this->addSql('CREATE INDEX IDX_B469456FBA364942 ON translation (entry_id)');
    }
}
