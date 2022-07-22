<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408232220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command CHANGE member_id member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD47597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('DROP INDEX member_id ON command');
        $this->addSql('CREATE INDEX IDX_8ECAEAD47597D3FE ON command (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD47597D3FE');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD47597D3FE');
        $this->addSql('ALTER TABLE command CHANGE member_id member_id INT NOT NULL');
        $this->addSql('DROP INDEX idx_8ecaead47597d3fe ON command');
        $this->addSql('CREATE INDEX member_id ON command (member_id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD47597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
    }
}
