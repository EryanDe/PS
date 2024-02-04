<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115114337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E3256915B FOREIGN KEY (relation_id) REFERENCES protocoles (id)');
        $this->addSql('CREATE INDEX IDX_497B315E3256915B ON utilisateurs (relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E3256915B');
        $this->addSql('DROP INDEX IDX_497B315E3256915B ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP relation_id');
    }
}
