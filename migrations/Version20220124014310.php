<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124014310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, login_id INT DEFAULT NULL, service_id INT NOT NULL, rf_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, start_worktime_id INT NOT NULL, UNIQUE INDEX UNIQ_70E4FA785CB2E05D (login_id), INDEX IDX_70E4FA78ED5CA9E6 (service_id), INDEX IDX_70E4FA78C27DF04F (rf_id), INDEX IDX_70E4FA781AD5CDBF (cart_id), INDEX IDX_70E4FA785657EC2E (start_worktime_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA785CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C27DF04F FOREIGN KEY (rf_id) REFERENCES rf (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA781AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA785657EC2E FOREIGN KEY (start_worktime_id) REFERENCES hour_worktime (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE member');
    }
}
