<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207015233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member ADD worktime_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C20FC9A FOREIGN KEY (worktime_id) REFERENCES hour_worktime (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78C20FC9A ON member (worktime_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C20FC9A');
        $this->addSql('DROP INDEX IDX_70E4FA78C20FC9A ON member');
        $this->addSql('ALTER TABLE member DROP worktime_id');
    }
}
