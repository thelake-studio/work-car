<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507155938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE group_schedule ADD owner_group_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE group_schedule ADD CONSTRAINT FK_53085D84E8B46084 FOREIGN KEY (owner_group_id) REFERENCES `group` (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_53085D84E8B46084 ON group_schedule (owner_group_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE group_schedule DROP FOREIGN KEY FK_53085D84E8B46084
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_53085D84E8B46084 ON group_schedule
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE group_schedule DROP owner_group_id
        SQL);
    }
}
