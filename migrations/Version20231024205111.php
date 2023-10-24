<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024205111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercices ADD semaines_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exercices ADD CONSTRAINT FK_1387EAE1176C008D FOREIGN KEY (semaines_id) REFERENCES semaines (id)');
        $this->addSql('CREATE INDEX IDX_1387EAE1176C008D ON exercices (semaines_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercices DROP FOREIGN KEY FK_1387EAE1176C008D');
        $this->addSql('DROP INDEX IDX_1387EAE1176C008D ON exercices');
        $this->addSql('ALTER TABLE exercices DROP semaines_id');
    }
}
