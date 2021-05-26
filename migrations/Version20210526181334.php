<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526181334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representant ADD empresa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE representant ADD CONSTRAINT FK_80D5DBC9521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('CREATE INDEX IDX_80D5DBC9521E1991 ON representant (empresa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE representant DROP FOREIGN KEY FK_80D5DBC9521E1991');
        $this->addSql('DROP INDEX IDX_80D5DBC9521E1991 ON representant');
        $this->addSql('ALTER TABLE representant DROP empresa_id');
    }
}
