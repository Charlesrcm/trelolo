<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925174328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE priorite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet ADD priorite_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA953B4F1DE FOREIGN KEY (priorite_id) REFERENCES priorite (id)');
        $this->addSql('CREATE INDEX IDX_50159CA953B4F1DE ON projet (priorite_id)');
        $this->addSql('ALTER TABLE utilisateur ADD nom VARCHAR(150) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA953B4F1DE');
        $this->addSql('DROP TABLE priorite');
        $this->addSql('DROP INDEX IDX_50159CA953B4F1DE ON projet');
        $this->addSql('ALTER TABLE projet DROP priorite_id');
        $this->addSql('ALTER TABLE utilisateur DROP nom');
    }
}
