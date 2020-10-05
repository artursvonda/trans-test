<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201005065201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO `language` (`id`, `name`, `rtl`) VALUES
            ('1', 'latvian', '0'),
            ('2', 'english', '0'),
            ('3', 'hebrew', '1'),
            ('4', 'arabic', '1'),
            ('5', 'russian', '0')
        ");

        $this->addSql("INSERT INTO `entry` (`id`, `name`) VALUES ('1', 'some.key.name')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
