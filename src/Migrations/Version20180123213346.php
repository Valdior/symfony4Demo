<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180123213346 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affiliate ADD archer_id INT DEFAULT NULL, ADD club_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF147940E3 FOREIGN KEY (archer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('CREATE INDEX IDX_597AA5CF147940E3 ON affiliate (archer_id)');
        $this->addSql('CREATE INDEX IDX_597AA5CF61190A32 ON affiliate (club_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affiliate DROP FOREIGN KEY FK_597AA5CF147940E3');
        $this->addSql('ALTER TABLE affiliate DROP FOREIGN KEY FK_597AA5CF61190A32');
        $this->addSql('DROP INDEX IDX_597AA5CF147940E3 ON affiliate');
        $this->addSql('DROP INDEX IDX_597AA5CF61190A32 ON affiliate');
        $this->addSql('ALTER TABLE affiliate DROP archer_id, DROP club_id');
    }
}
