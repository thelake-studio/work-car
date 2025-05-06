<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506165611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle ADD owner_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1B80E4867E3C61F9 ON vehicle (owner_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1B80E4867E3C61F9 ON vehicle
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle DROP owner_id
        SQL);
    }
}
