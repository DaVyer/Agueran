<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202144329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, utiliser_id INT DEFAULT NULL, lib_activite VARCHAR(150) NOT NULL, date_activite DATE NOT NULL, heure_debut_activite TIME NOT NULL, heure_fin_activite TIME NOT NULL, desc_activite VARCHAR(500) DEFAULT NULL, nb_visiteur_max_activite INT NOT NULL, tarif_activite INT DEFAULT NULL, est_activite_animal TINYINT(1) NOT NULL, image LONGBLOB DEFAULT NULL, INDEX IDX_B8755515F6A812E5 (utiliser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_user (activite_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FA43CF3B9B0F88B1 (activite_id), INDEX IDX_FA43CF3BA76ED395 (user_id), PRIMARY KEY(activite_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, enclos_id INT NOT NULL, utiliser_id INT DEFAULT NULL, nom_animal VARCHAR(150) NOT NULL, lieu_originaire_animal VARCHAR(150) NOT NULL, desc_animal VARCHAR(500) DEFAULT NULL, image LONGBLOB DEFAULT NULL, INDEX IDX_6AAB231F97A77B84 (famille_id), INDEX IDX_6AAB231FB1C0859 (enclos_id), INDEX IDX_6AAB231FF6A812E5 (utiliser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_user (animal_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CABE977D8E962C16 (animal_id), INDEX IDX_CABE977DA76ED395 (user_id), PRIMARY KEY(animal_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT DEFAULT NULL, date_achat DATE NOT NULL, date_reservation DATE NOT NULL, INDEX IDX_1F034AF67F72333D (visiteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enclos (id INT AUTO_INCREMENT NOT NULL, activite_id INT DEFAULT NULL, nom_enclos VARCHAR(150) NOT NULL, lieu_enclos VARCHAR(150) DEFAULT NULL, desc_enclos VARCHAR(500) DEFAULT NULL, INDEX IDX_8CCECB219B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, nom_famille VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserver (id INT AUTO_INCREMENT NOT NULL, activite_id INT NOT NULL, date_reservation DATE NOT NULL, nb_visiteurs INT NOT NULL, INDEX IDX_B9765E939B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, reserver_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, telephone VARCHAR(20) NOT NULL, adresse VARCHAR(100) NOT NULL, code_postal VARCHAR(6) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64944A67F3 (reserver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utiliser (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515F6A812E5 FOREIGN KEY (utiliser_id) REFERENCES utiliser (id)');
        $this->addSql('ALTER TABLE activite_user ADD CONSTRAINT FK_FA43CF3B9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_user ADD CONSTRAINT FK_FA43CF3BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FF6A812E5 FOREIGN KEY (utiliser_id) REFERENCES utiliser (id)');
        $this->addSql('ALTER TABLE animal_user ADD CONSTRAINT FK_CABE977D8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_user ADD CONSTRAINT FK_CABE977DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF67F72333D FOREIGN KEY (visiteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE enclos ADD CONSTRAINT FK_8CCECB219B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E939B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64944A67F3 FOREIGN KEY (reserver_id) REFERENCES reserver (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515F6A812E5');
        $this->addSql('ALTER TABLE activite_user DROP FOREIGN KEY FK_FA43CF3B9B0F88B1');
        $this->addSql('ALTER TABLE activite_user DROP FOREIGN KEY FK_FA43CF3BA76ED395');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F97A77B84');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB1C0859');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FF6A812E5');
        $this->addSql('ALTER TABLE animal_user DROP FOREIGN KEY FK_CABE977D8E962C16');
        $this->addSql('ALTER TABLE animal_user DROP FOREIGN KEY FK_CABE977DA76ED395');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF67F72333D');
        $this->addSql('ALTER TABLE enclos DROP FOREIGN KEY FK_8CCECB219B0F88B1');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E939B0F88B1');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64944A67F3');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE activite_user');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE animal_user');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE enclos');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE reserver');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE utiliser');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
