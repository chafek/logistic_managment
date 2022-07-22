<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204143223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE state');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C363984D');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA789E918A14');
        $this->addSql('DROP INDEX IDX_70E4FA789E918A14 ON member');
        $this->addSql('DROP INDEX IDX_70E4FA78C363984D ON member');
        $this->addSql('ALTER TABLE member DROP worktime_start_id, DROP worktime_end_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, note SMALLINT DEFAULT NULL, designation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE member ADD worktime_start_id INT DEFAULT NULL, ADD worktime_end_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C363984D FOREIGN KEY (worktime_end_id) REFERENCES hour_worktime (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA789E918A14 FOREIGN KEY (worktime_start_id) REFERENCES hour_worktime (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA789E918A14 ON member (worktime_start_id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78C363984D ON member (worktime_end_id)');
    }
}
