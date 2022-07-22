<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220206171439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD state_id INT DEFAULT NULL, DROP state');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B75D83CC1 FOREIGN KEY (state_id) REFERENCES item_state (id)');
        $this->addSql('CREATE INDEX IDX_BA388B75D83CC1 ON cart (state_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B75D83CC1');
        $this->addSql('DROP INDEX IDX_BA388B75D83CC1 ON cart');
        $this->addSql('ALTER TABLE cart ADD state VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP state_id');
    }
}
