<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108225932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser ADD activite_id INT NOT NULL, ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491099B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491098E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_5C9491099B0F88B1 ON utiliser (activite_id)');
        $this->addSql('CREATE INDEX IDX_5C9491098E962C16 ON utiliser (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491099B0F88B1');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491098E962C16');
        $this->addSql('DROP INDEX IDX_5C9491099B0F88B1 ON utiliser');
        $this->addSql('DROP INDEX IDX_5C9491098E962C16 ON utiliser');
        $this->addSql('ALTER TABLE utiliser DROP activite_id, DROP animal_id');
    }
}
