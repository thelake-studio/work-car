<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507155308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE non_available_time ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE non_available_time ADD CONSTRAINT FK_8E5419F4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8E5419F4A76ED395 ON non_available_time (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE non_available_time DROP FOREIGN KEY FK_8E5419F4A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8E5419F4A76ED395 ON non_available_time
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE non_available_time DROP user_id
        SQL);
    }
}
