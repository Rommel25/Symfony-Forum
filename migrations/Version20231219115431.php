<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219115431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_edition (atelier_id INT NOT NULL, edition_id INT NOT NULL, INDEX IDX_9AA843A782E2CF35 (atelier_id), INDEX IDX_9AA843A774281A5E (edition_id), PRIMARY KEY(atelier_id, edition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_ressources (atelier_id INT NOT NULL, ressources_id INT NOT NULL, INDEX IDX_A72B76CA82E2CF35 (atelier_id), INDEX IDX_A72B76CA3C361826 (ressources_id), PRIMARY KEY(atelier_id, ressources_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, sponsor_id INT DEFAULT NULL, annee INT NOT NULL, INDEX IDX_A891181F12F7FB51 (sponsor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lycee (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, reponse VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire_edition (questionnaire_id INT NOT NULL, edition_id INT NOT NULL, INDEX IDX_F70D3618CE07E8FF (questionnaire_id), INDEX IDX_F70D361874281A5E (edition_id), PRIMARY KEY(questionnaire_id, edition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire_question (questionnaire_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_28CC40C3CE07E8FF (questionnaire_id), INDEX IDX_28CC40C31E27F6BF (question_id), PRIMARY KEY(questionnaire_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier_edition ADD CONSTRAINT FK_9AA843A782E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_edition ADD CONSTRAINT FK_9AA843A774281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_ressources ADD CONSTRAINT FK_A72B76CA82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_ressources ADD CONSTRAINT FK_A72B76CA3C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE questionnaire_edition ADD CONSTRAINT FK_F70D3618CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_edition ADD CONSTRAINT FK_F70D361874281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C3CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C31E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier DROP ressources');
        $this->addSql('ALTER TABLE user ADD lycee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D1DC61BF ON user (lycee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D1DC61BF');
        $this->addSql('ALTER TABLE atelier_edition DROP FOREIGN KEY FK_9AA843A782E2CF35');
        $this->addSql('ALTER TABLE atelier_edition DROP FOREIGN KEY FK_9AA843A774281A5E');
        $this->addSql('ALTER TABLE atelier_ressources DROP FOREIGN KEY FK_A72B76CA82E2CF35');
        $this->addSql('ALTER TABLE atelier_ressources DROP FOREIGN KEY FK_A72B76CA3C361826');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F12F7FB51');
        $this->addSql('ALTER TABLE questionnaire_edition DROP FOREIGN KEY FK_F70D3618CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_edition DROP FOREIGN KEY FK_F70D361874281A5E');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C3CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C31E27F6BF');
        $this->addSql('DROP TABLE atelier_edition');
        $this->addSql('DROP TABLE atelier_ressources');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE lycee');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE questionnaire_edition');
        $this->addSql('DROP TABLE questionnaire_question');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('ALTER TABLE atelier ADD ressources VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_8D93D649D1DC61BF ON user');
        $this->addSql('ALTER TABLE user DROP lycee_id');
    }
}
