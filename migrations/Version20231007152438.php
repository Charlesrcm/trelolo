<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007152438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP INDEX UNIQ_50159CA9642B8210, ADD INDEX IDX_50159CA9B981C689 (utilisateur_id_id)');
        $this->addSql('ALTER TABLE tache ADD utilisateur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075B981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_93872075B981C689 ON tache (utilisateur_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP INDEX IDX_50159CA9B981C689, ADD UNIQUE INDEX UNIQ_50159CA9642B8210 (utilisateur_id_id)');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075B981C689');
        $this->addSql('DROP INDEX IDX_93872075B981C689 ON tache');
        $this->addSql('ALTER TABLE tache DROP utilisateur_id_id');
    }
}
