<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171231083724 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD is_expired TINYINT(1) NOT NULL, ADD is_locked TINYINT(1) NOT NULL, ADD is_credentials_expired TINYINT(1) NOT NULL, DROP is_account_non_expired, DROP is_account_non_locked, DROP is_credentials_non_expired');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD is_account_non_expired TINYINT(1) NOT NULL, ADD is_account_non_locked TINYINT(1) NOT NULL, ADD is_credentials_non_expired TINYINT(1) NOT NULL, DROP is_expired, DROP is_locked, DROP is_credentials_expired');
    }
}
