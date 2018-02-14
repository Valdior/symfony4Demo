<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180214164901 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE peloton ADD tournament_id INT NOT NULL');
        $this->addSql('ALTER TABLE peloton ADD CONSTRAINT FK_D2D171E33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('CREATE INDEX IDX_D2D171E33D1A3E7 ON peloton (tournament_id)');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D936FA7F47');
        $this->addSql('DROP INDEX IDX_BD5FB8D936FA7F47 ON tournament');
        $this->addSql('ALTER TABLE tournament DROP pelotons_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE peloton DROP FOREIGN KEY FK_D2D171E33D1A3E7');
        $this->addSql('DROP INDEX IDX_D2D171E33D1A3E7 ON peloton');
        $this->addSql('ALTER TABLE peloton DROP tournament_id');
        $this->addSql('ALTER TABLE tournament ADD pelotons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D936FA7F47 FOREIGN KEY (pelotons_id) REFERENCES peloton (id)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D936FA7F47 ON tournament (pelotons_id)');
    }
}
