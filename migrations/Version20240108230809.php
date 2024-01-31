<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108230809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491099B0F88B1');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491098E962C16');
        $this->addSql('DROP INDEX IDX_5C9491099B0F88B1 ON utiliser');
        $this->addSql('DROP INDEX IDX_5C9491098E962C16 ON utiliser');
        $this->addSql('ALTER TABLE utiliser ADD animal_id_id INT DEFAULT NULL, ADD activiter_id_id INT DEFAULT NULL, DROP activite_id, DROP animal_id');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491095EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491092274EEF3 FOREIGN KEY (activiter_id_id) REFERENCES activite (id)');
        $this->addSql('CREATE INDEX IDX_5C9491095EB747A3 ON utiliser (animal_id_id)');
        $this->addSql('CREATE INDEX IDX_5C9491092274EEF3 ON utiliser (activiter_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491095EB747A3');
        $this->addSql('ALTER TABLE utiliser DROP FOREIGN KEY FK_5C9491092274EEF3');
        $this->addSql('DROP INDEX IDX_5C9491095EB747A3 ON utiliser');
        $this->addSql('DROP INDEX IDX_5C9491092274EEF3 ON utiliser');
        $this->addSql('ALTER TABLE utiliser ADD activite_id INT NOT NULL, ADD animal_id INT NOT NULL, DROP animal_id_id, DROP activiter_id_id');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491099B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE utiliser ADD CONSTRAINT FK_5C9491098E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_5C9491099B0F88B1 ON utiliser (activite_id)');
        $this->addSql('CREATE INDEX IDX_5C9491098E962C16 ON utiliser (animal_id)');
    }
}
