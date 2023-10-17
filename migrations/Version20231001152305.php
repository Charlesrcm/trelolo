<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231001152305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE projet DROP INDEX IDX_50159CA9642B8210, ADD UNIQUE INDEX UNIQ_50159CA9642B8210 (admin_id)');
        // $this->addSql('ALTER TABLE projet ADD admin_id_id INT NOT NULL, CHANGE admin_id admin_id INT NOT NULL');
        // $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9DF6E65AD FOREIGN KEY (admin_id_id) REFERENCES utilisateur (id)');
        // $this->addSql('CREATE INDEX IDX_50159CA9DF6E65AD ON projet (admin_id)');
        $this->addSql('ALTER TABLE utilisateur DROP projet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE projet DROP INDEX UNIQ_50159CA9642B8210, ADD INDEX IDX_50159CA9642B8210 (admin_id)');
        // $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9DF6E65AD');
        $this->addSql('DROP INDEX IDX_50159CA9DF6E65AD ON projet');
        // $this->addSql('ALTER TABLE projet DROP admin_id_id, CHANGE admin_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD projet_id INT NOT NULL');
    }
}
