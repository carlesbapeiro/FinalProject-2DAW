<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608154040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE practica (id INT AUTO_INCREMENT NOT NULL, alumne_id INT NOT NULL, empresa_id INT DEFAULT NULL, periode VARCHAR(100) NOT NULL, any DATE NOT NULL, observacions VARCHAR(255) DEFAULT NULL, INDEX IDX_7881F0579395058A (alumne_id), INDEX IDX_7881F057521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE practica ADD CONSTRAINT FK_7881F0579395058A FOREIGN KEY (alumne_id) REFERENCES alumne (id)');
        $this->addSql('ALTER TABLE practica ADD CONSTRAINT FK_7881F057521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accio DROP FOREIGN KEY FK_6840285381B1AF76');
        $this->addSql('DROP TABLE practica');
    }
}
