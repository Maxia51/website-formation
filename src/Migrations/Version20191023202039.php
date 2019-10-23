<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191023202039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE lesson (id INT NOT NULL, formation_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, content TEXT NOT NULL, author VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F87474F35200282E ON lesson (formation_id)');
        $this->addSql('CREATE TABLE formation (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, author VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F35200282E FOREIGN KEY (formation_id) REFERENCES formation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT FK_F87474F35200282E');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE formation');
    }
}
