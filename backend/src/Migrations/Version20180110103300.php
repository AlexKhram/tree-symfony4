<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180110103300 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parent DROP FOREIGN KEY FK_3D8E604F217BBB47');
        $this->addSql('DROP INDEX IDX_3D8E604F217BBB47 ON parent');
        $this->addSql('ALTER TABLE parent DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE parent CHANGE person_id parent_person_id INT NOT NULL');
        $this->addSql('ALTER TABLE parent ADD CONSTRAINT FK_3D8E604FD03094A9 FOREIGN KEY (parent_person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_3D8E604FD03094A9 ON parent (parent_person_id)');
        $this->addSql('ALTER TABLE parent ADD PRIMARY KEY (child_person_id, parent_person_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE parent DROP FOREIGN KEY FK_3D8E604FD03094A9');
        $this->addSql('DROP INDEX IDX_3D8E604FD03094A9 ON parent');
        $this->addSql('ALTER TABLE parent DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE parent CHANGE parent_person_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE parent ADD CONSTRAINT FK_3D8E604F217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_3D8E604F217BBB47 ON parent (person_id)');
        $this->addSql('ALTER TABLE parent ADD PRIMARY KEY (child_person_id, person_id)');
    }
}
