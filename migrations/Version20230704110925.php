<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704110925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove car_id NOT NULL on Contact table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_image ALTER size DROP NOT NULL');
        $this->addSql('ALTER TABLE contact ALTER car_id DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contact ALTER car_id SET NOT NULL');
        $this->addSql('ALTER TABLE car_image ALTER size SET NOT NULL');
    }
}
