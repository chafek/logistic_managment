<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220313202617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, service_id INT DEFAULT NULL, internal_number VARCHAR(10) NOT NULL, mark VARCHAR(20) NOT NULL, serial_number VARCHAR(255) NOT NULL, type VARCHAR(50) NOT NULL, rent_date_start DATETIME NOT NULL, rent_date_end DATETIME NOT NULL, model VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_BA388B75D83CC1 (state_id), INDEX IDX_BA388B7ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hour_worktime (id INT AUTO_INCREMENT NOT NULL, start_hour TIME NOT NULL, end_hour TIME NOT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_state (id INT AUTO_INCREMENT NOT NULL, note SMALLINT DEFAULT NULL, designation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, job VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, rf_id INT DEFAULT NULL, cart_id INT DEFAULT NULL, worktime_id INT DEFAULT NULL, my_login_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_70E4FA78ED5CA9E6 (service_id), INDEX IDX_70E4FA78C27DF04F (rf_id), INDEX IDX_70E4FA781AD5CDBF (cart_id), INDEX IDX_70E4FA78C20FC9A (worktime_id), UNIQUE INDEX UNIQ_70E4FA786EE07512 (my_login_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE my_login (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operator (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, job_id INT DEFAULT NULL, productivity DOUBLE PRECISION DEFAULT NULL, quality DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_D7A6A7817597D3FE (member_id), INDEX IDX_D7A6A781BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rf (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, owning_date DATETIME DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, serial_number VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, INDEX IDX_F801CDE65D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, service VARCHAR(20) NOT NULL, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B75D83CC1 FOREIGN KEY (state_id) REFERENCES item_state (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C27DF04F FOREIGN KEY (rf_id) REFERENCES rf (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA781AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78C20FC9A FOREIGN KEY (worktime_id) REFERENCES hour_worktime (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA786EE07512 FOREIGN KEY (my_login_id) REFERENCES my_login (id)');
        $this->addSql('ALTER TABLE operator ADD CONSTRAINT FK_D7A6A7817597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE operator ADD CONSTRAINT FK_D7A6A781BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE rf ADD CONSTRAINT FK_F801CDE65D83CC1 FOREIGN KEY (state_id) REFERENCES item_state (id)');
        $this->addSql('DROP TABLE command');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA781AD5CDBF');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C20FC9A');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B75D83CC1');
        $this->addSql('ALTER TABLE rf DROP FOREIGN KEY FK_F801CDE65D83CC1');
        $this->addSql('ALTER TABLE operator DROP FOREIGN KEY FK_D7A6A781BE04EA9');
        $this->addSql('ALTER TABLE operator DROP FOREIGN KEY FK_D7A6A7817597D3FE');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA786EE07512');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78C27DF04F');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7ED5CA9E6');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78ED5CA9E6');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, data_movimento DATE NOT NULL, ora_movimento TIME NOT NULL, tipo_movimento VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, des_causale VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, profilo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ditta VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, articolo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, des_articolo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, segno VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, quantita INT DEFAULT NULL, un_mis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, peso DOUBLE PRECISION DEFAULT NULL, area_or VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zona_or VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, fronte_or VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, colonna_or VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, piano_or VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, area_de VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zona_de VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, fronte_de VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, colonna_de VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, piano_de VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, riga_ord INT DEFAULT NULL, stato_prod_in VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, stato_prod_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE hour_worktime');
        $this->addSql('DROP TABLE item_state');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE my_login');
        $this->addSql('DROP TABLE operator');
        $this->addSql('DROP TABLE rf');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
    }
}
