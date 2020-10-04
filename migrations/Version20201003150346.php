<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003150346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE translation DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE translation DROP id, CHANGE language_id language_id INT NOT NULL, CHANGE entry_id entry_id INT NOT NULL');
        $this->addSql('ALTER TABLE translation ADD PRIMARY KEY (language_id, entry_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translation ADD id INT AUTO_INCREMENT NOT NULL, CHANGE language_id language_id INT DEFAULT NULL, CHANGE entry_id entry_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
