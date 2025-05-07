<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507155756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE group_location ADD owner_group_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE group_location ADD CONSTRAINT FK_57AEC5B4E8B46084 FOREIGN KEY (owner_group_id) REFERENCES `group` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_57AEC5B4E8B46084 ON group_location (owner_group_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE group_location DROP FOREIGN KEY FK_57AEC5B4E8B46084
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_57AEC5B4E8B46084 ON group_location
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE group_location DROP owner_group_id
        SQL);
    }
}
