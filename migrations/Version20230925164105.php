<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925164105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD amdin_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9D6BC960B FOREIGN KEY (amdin_id) REFERENCES `admin` (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9D6BC960B ON projet (amdin_id)');
        $this->addSql('ALTER TABLE utilisateur ADD is_admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9D6BC960B');
        $this->addSql('DROP INDEX IDX_50159CA9D6BC960B ON projet');
        $this->addSql('ALTER TABLE projet DROP amdin_id');
        $this->addSql('ALTER TABLE utilisateur DROP is_admin');
    }
}
