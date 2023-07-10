<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630074557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Cascade removal to Car-Contact relation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE contact DROP CONSTRAINT FK_4C62E638C3C6F69F');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact DROP CONSTRAINT fk_4c62e638c3c6f69f');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT fk_4c62e638c3c6f69f FOREIGN KEY (car_id) REFERENCES car (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
