<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219131931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, entreprise VARCHAR(255) NOT NULL, INDEX IDX_73D0145C82E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lyceen (id INT AUTO_INCREMENT NOT NULL, lycee VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, competences LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', activites LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_51A00D8C82E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_atelier (user_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_B9B60629A76ED395 (user_id), INDEX IDX_B9B6062982E2CF35 (atelier_id), PRIMARY KEY(user_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE user_atelier ADD CONSTRAINT FK_B9B60629A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_atelier ADD CONSTRAINT FK_B9B6062982E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145C82E2CF35');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C82E2CF35');
        $this->addSql('ALTER TABLE user_atelier DROP FOREIGN KEY FK_B9B60629A76ED395');
        $this->addSql('ALTER TABLE user_atelier DROP FOREIGN KEY FK_B9B6062982E2CF35');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE lyceen');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE user_atelier');
        $this->addSql('DROP TABLE messenger_messages');
    }
}