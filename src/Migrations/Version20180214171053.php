<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180214171053 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE peloton DROP FOREIGN KEY FK_D2D171E838709D5');
        $this->addSql('DROP INDEX IDX_D2D171E838709D5 ON peloton');
        $this->addSql('ALTER TABLE peloton DROP participants_id');
        $this->addSql('ALTER TABLE participant ADD participation_id INT NOT NULL, ADD archer_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B116ACE3B73 FOREIGN KEY (participation_id) REFERENCES peloton (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11147940E3 FOREIGN KEY (archer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B116ACE3B73 ON participant (participation_id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11147940E3 ON participant (archer_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B116ACE3B73');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11147940E3');
        $this->addSql('DROP INDEX IDX_D79F6B116ACE3B73 ON participant');
        $this->addSql('DROP INDEX IDX_D79F6B11147940E3 ON participant');
        $this->addSql('ALTER TABLE participant DROP participation_id, DROP archer_id');
        $this->addSql('ALTER TABLE peloton ADD participants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE peloton ADD CONSTRAINT FK_D2D171E838709D5 FOREIGN KEY (participants_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D2D171E838709D5 ON peloton (participants_id)');
    }
}
