<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125014429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE update_at update_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA785657EC2E');
        $this->addSql('DROP INDEX IDX_70E4FA785657EC2E ON member');
        $this->addSql('DROP INDEX end_worktime_id ON member');
        $this->addSql('ALTER TABLE member ADD worktime_start_id INT DEFAULT NULL, ADD worktime_end_id INT DEFAULT NULL, DROP start_worktime_id, DROP end_worktime_id');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA789E918A14 FOREIGN KEY (worktime_start_id) REFERENCES hour_worktime (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C363984D FOREIGN KEY (worktime_end_id) REFERENCES hour_worktime (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA789E918A14 ON member (worktime_start_id)');
        $this->addSql('CREATE INDEX IDX_70E4FA78C363984D ON member (worktime_end_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login CHANGE created_at created_at DATETIME NOT NULL, CHANGE update_at update_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA789E918A14');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C363984D');
        $this->addSql('DROP INDEX IDX_70E4FA789E918A14 ON member');
        $this->addSql('DROP INDEX IDX_70E4FA78C363984D ON member');
        $this->addSql('ALTER TABLE member ADD start_worktime_id INT NOT NULL, ADD end_worktime_id INT NOT NULL, DROP worktime_start_id, DROP worktime_end_id');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA785657EC2E FOREIGN KEY (start_worktime_id) REFERENCES hour_worktime (id)');
        $this->addSql('CREATE INDEX IDX_70E4FA785657EC2E ON member (start_worktime_id)');
        $this->addSql('CREATE INDEX end_worktime_id ON member (end_worktime_id)');
    }
}
