<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315095959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, data_movimento DATE DEFAULT NULL, ora_movimento TIME NOT NULL, des_causale VARCHAR(255) DEFAULT NULL, profilo VARCHAR(255) NOT NULL, articolo VARCHAR(255) DEFAULT NULL, des_articolo VARCHAR(255) DEFAULT NULL, segno VARCHAR(255) DEFAULT NULL, quantita INT DEFAULT NULL, un_mis VARCHAR(255) DEFAULT NULL, peso DOUBLE PRECISION DEFAULT NULL, area_or VARCHAR(255) DEFAULT NULL, zona_or VARCHAR(255) DEFAULT NULL, fronte_or VARCHAR(255) DEFAULT NULL, colonna_or VARCHAR(255) DEFAULT NULL, piano_or VARCHAR(255) DEFAULT NULL, area_de VARCHAR(255) DEFAULT NULL, zona_de VARCHAR(255) DEFAULT NULL, fronte_de VARCHAR(255) DEFAULT NULL, colonna_de VARCHAR(255) DEFAULT NULL, piano_de VARCHAR(255) DEFAULT NULL, riga_ord INT DEFAULT NULL, stato_prod_in VARCHAR(255) DEFAULT NULL, stato_prod_fin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE command');
    }
}
