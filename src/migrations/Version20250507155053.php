<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507155053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE personal_location ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personal_location ADD CONSTRAINT FK_F2A15782A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2A15782A76ED395 ON personal_location (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE personal_location DROP FOREIGN KEY FK_F2A15782A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2A15782A76ED395 ON personal_location
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personal_location DROP user_id
        SQL);
    }
}
