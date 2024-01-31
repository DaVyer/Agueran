<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109142821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_user DROP FOREIGN KEY FK_FA43CF3BA76ED395');
        $this->addSql('ALTER TABLE activite_user DROP FOREIGN KEY FK_FA43CF3B9B0F88B1');
        $this->addSql('DROP TABLE activite_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_user (activite_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FA43CF3BA76ED395 (user_id), INDEX IDX_FA43CF3B9B0F88B1 (activite_id), PRIMARY KEY(activite_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE activite_user ADD CONSTRAINT FK_FA43CF3BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_user ADD CONSTRAINT FK_FA43CF3B9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
    }
}
