<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526193241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accio ADD practica_id INT NOT NULL');
        $this->addSql('ALTER TABLE accio ADD CONSTRAINT FK_6840285381B1AF76 FOREIGN KEY (practica_id) REFERENCES practica (id)');
        $this->addSql('CREATE INDEX IDX_6840285381B1AF76 ON accio (practica_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accio DROP FOREIGN KEY FK_6840285381B1AF76');
        $this->addSql('DROP INDEX IDX_6840285381B1AF76 ON accio');
        $this->addSql('ALTER TABLE accio DROP practica_id');
    }
}
