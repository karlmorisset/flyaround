<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214160712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, from_city_id INT NOT NULL, to_city_id INT NOT NULL, distance INT DEFAULT NULL, INDEX IDX_7656F53BDF28100 (from_city_id), INDEX IDX_7656F53B5345F5A (to_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BDF28100 FOREIGN KEY (from_city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B5345F5A FOREIGN KEY (to_city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE trip');
    }
}
