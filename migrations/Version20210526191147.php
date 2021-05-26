<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526191147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accio ADD representant_id INT NOT NULL');
        $this->addSql('ALTER TABLE accio ADD CONSTRAINT FK_684028536C4A52F0 FOREIGN KEY (representant_id) REFERENCES representant (id)');
        $this->addSql('CREATE INDEX IDX_684028536C4A52F0 ON accio (representant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accio DROP FOREIGN KEY FK_684028536C4A52F0');
        $this->addSql('DROP INDEX IDX_684028536C4A52F0 ON accio');
        $this->addSql('ALTER TABLE accio DROP representant_id');
    }
}
