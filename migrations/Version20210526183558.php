<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526183558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumne_cicle (alumne_id INT NOT NULL, cicle_id INT NOT NULL, INDEX IDX_E82AD0209395058A (alumne_id), INDEX IDX_E82AD02062328DAC (cicle_id), PRIMARY KEY(alumne_id, cicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumne_cicle ADD CONSTRAINT FK_E82AD0209395058A FOREIGN KEY (alumne_id) REFERENCES alumne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumne_cicle ADD CONSTRAINT FK_E82AD02062328DAC FOREIGN KEY (cicle_id) REFERENCES cicle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alumne_cicle');
    }
}
