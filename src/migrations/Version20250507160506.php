<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507160506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE planned_trip_user (planned_trip_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_23EF8126E594C93A (planned_trip_id), INDEX IDX_23EF8126A76ED395 (user_id), PRIMARY KEY(planned_trip_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip_user ADD CONSTRAINT FK_23EF8126E594C93A FOREIGN KEY (planned_trip_id) REFERENCES planned_trip (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip_user ADD CONSTRAINT FK_23EF8126A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip ADD driver_id INT NOT NULL, ADD owner_group_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip ADD CONSTRAINT FK_CD0E98A6C3423909 FOREIGN KEY (driver_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip ADD CONSTRAINT FK_CD0E98A6E8B46084 FOREIGN KEY (owner_group_id) REFERENCES `group` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CD0E98A6C3423909 ON planned_trip (driver_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CD0E98A6E8B46084 ON planned_trip (owner_group_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip_user DROP FOREIGN KEY FK_23EF8126E594C93A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip_user DROP FOREIGN KEY FK_23EF8126A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE planned_trip_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip DROP FOREIGN KEY FK_CD0E98A6C3423909
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip DROP FOREIGN KEY FK_CD0E98A6E8B46084
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_CD0E98A6C3423909 ON planned_trip
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_CD0E98A6E8B46084 ON planned_trip
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE planned_trip DROP driver_id, DROP owner_group_id
        SQL);
    }
}
