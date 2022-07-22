<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221091539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_login ADD member_id INT NOT NULL');
        $this->addSql('ALTER TABLE my_login ADD CONSTRAINT FK_C6CE79D47597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6CE79D47597D3FE ON my_login (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE my_login DROP FOREIGN KEY FK_C6CE79D47597D3FE');
        $this->addSql('DROP INDEX UNIQ_C6CE79D47597D3FE ON my_login');
        $this->addSql('ALTER TABLE my_login DROP member_id');
    }
}
