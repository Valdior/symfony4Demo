<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180408185519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B116ACE3B73');
        $this->addSql('DROP INDEX IDX_D79F6B116ACE3B73 ON participant');
        $this->addSql('ALTER TABLE participant CHANGE participation_id peloton_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1130A593A4 FOREIGN KEY (peloton_id) REFERENCES peloton (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B1130A593A4 ON participant (peloton_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1130A593A4');
        $this->addSql('DROP INDEX IDX_D79F6B1130A593A4 ON participant');
        $this->addSql('ALTER TABLE participant CHANGE peloton_id participation_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B116ACE3B73 FOREIGN KEY (participation_id) REFERENCES peloton (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B116ACE3B73 ON participant (participation_id)');
    }
}
