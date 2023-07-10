<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628093802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add OpeningHours Table and image field in HomeContent';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE opening_hours_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE opening_hours (id INT NOT NULL, content VARCHAR(500) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE home_content ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE opening_hours_id_seq CASCADE');
        $this->addSql('DROP TABLE opening_hours');
        $this->addSql('ALTER TABLE home_content DROP image');
    }
}
