<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217131045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FBCF5E72D ON animal (categorie_id)');
        $this->addSql('ALTER TABLE reserver ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E93A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B9765E93A76ED395 ON reserver (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64944A67F3');
        $this->addSql('DROP INDEX IDX_8D93D64944A67F3 ON user');
        $this->addSql('ALTER TABLE user DROP reserver_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FBCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_6AAB231FBCF5E72D ON animal');
        $this->addSql('ALTER TABLE animal DROP categorie_id');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E93A76ED395');
        $this->addSql('DROP INDEX IDX_B9765E93A76ED395 ON reserver');
        $this->addSql('ALTER TABLE reserver DROP user_id');
        $this->addSql('ALTER TABLE `user` ADD reserver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64944A67F3 FOREIGN KEY (reserver_id) REFERENCES reserver (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64944A67F3 ON `user` (reserver_id)');
    }
}
