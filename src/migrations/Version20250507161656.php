<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507161656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recorded_trip ADD planned_trip_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recorded_trip ADD CONSTRAINT FK_A1B922B0E594C93A FOREIGN KEY (planned_trip_id) REFERENCES planned_trip (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_A1B922B0E594C93A ON recorded_trip (planned_trip_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recorded_trip DROP FOREIGN KEY FK_A1B922B0E594C93A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_A1B922B0E594C93A ON recorded_trip
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recorded_trip DROP planned_trip_id
        SQL);
    }
}
