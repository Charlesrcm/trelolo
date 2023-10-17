<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929174149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP priorite');
        $this->addSql('ALTER TABLE projet RENAME INDEX idx_50159ca9d6bc960b TO IDX_50159CA9642B8210');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD priorite VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE projet RENAME INDEX idx_50159ca9642b8210 TO IDX_50159CA9D6BC960B');
    }
}
