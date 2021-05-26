<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526190235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumne ADD professor_id INT NOT NULL');
        $this->addSql('ALTER TABLE alumne ADD CONSTRAINT FK_F4E03C337D2D84D5 FOREIGN KEY (professor_id) REFERENCES professor (id)');
        $this->addSql('CREATE INDEX IDX_F4E03C337D2D84D5 ON alumne (professor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumne DROP FOREIGN KEY FK_F4E03C337D2D84D5');
        $this->addSql('DROP INDEX IDX_F4E03C337D2D84D5 ON alumne');
        $this->addSql('ALTER TABLE alumne DROP professor_id');
    }
}
