<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221101943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA785CB2E05D');
        $this->addSql('DROP TABLE login');
        $this->addSql('DROP INDEX UNIQ_70E4FA785CB2E05D ON member');
        $this->addSql('ALTER TABLE member DROP login_id');
        $this->addSql('ALTER TABLE my_login ADD member_id INT NOT NULL');
        $this->addSql('ALTER TABLE my_login ADD CONSTRAINT FK_C6CE79D47597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6CE79D47597D3FE ON my_login (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE login (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE member ADD login_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA785CB2E05D FOREIGN KEY (login_id) REFERENCES login (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA785CB2E05D ON member (login_id)');
        $this->addSql('ALTER TABLE my_login DROP FOREIGN KEY FK_C6CE79D47597D3FE');
        $this->addSql('DROP INDEX UNIQ_C6CE79D47597D3FE ON my_login');
        $this->addSql('ALTER TABLE my_login DROP member_id');
    }
}
