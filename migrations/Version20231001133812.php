<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001133812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9D6BC960B');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9642B8210 FOREIGN KEY (admin_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3C18272 ON utilisateur (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9642B8210');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9D6BC960B FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C18272');
        $this->addSql('DROP INDEX IDX_1D1C63B3C18272 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP projet_id');
    }
}
