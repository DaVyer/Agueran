<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108224605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515F6A812E5');
        $this->addSql('DROP INDEX IDX_B8755515F6A812E5 ON activite');
        $this->addSql('ALTER TABLE activite DROP utiliser_id');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FF6A812E5');
        $this->addSql('DROP INDEX IDX_6AAB231FF6A812E5 ON animal');
        $this->addSql('ALTER TABLE animal DROP utiliser_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite ADD utiliser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515F6A812E5 FOREIGN KEY (utiliser_id) REFERENCES utiliser (id)');
        $this->addSql('CREATE INDEX IDX_B8755515F6A812E5 ON activite (utiliser_id)');
        $this->addSql('ALTER TABLE animal ADD utiliser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FF6A812E5 FOREIGN KEY (utiliser_id) REFERENCES utiliser (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FF6A812E5 ON animal (utiliser_id)');
    }
}
