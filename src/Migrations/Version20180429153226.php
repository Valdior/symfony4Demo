<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180429153226 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE archer_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, minimum_age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participant CHANGE category category_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1112469DE2 FOREIGN KEY (category_id) REFERENCES archer_category (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B1112469DE2 ON participant (category_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1112469DE2');
        $this->addSql('DROP TABLE archer_category');
        $this->addSql('DROP INDEX IDX_D79F6B1112469DE2 ON participant');
        $this->addSql('ALTER TABLE participant CHANGE category_id category INT NOT NULL');
    }
}
