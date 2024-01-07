<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107134533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_metier (activite_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_28C2C9E89B0F88B1 (activite_id), INDEX IDX_28C2C9E8ED16FA20 (metier_id), PRIMARY KEY(activite_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, secteur_id INT DEFAULT NULL, salle_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_E1BB18239F7E4405 (secteur_id), INDEX IDX_E1BB1823DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_as_metier (atelier_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_6A94BCBE82E2CF35 (atelier_id), INDEX IDX_6A94BCBEED16FA20 (metier_id), PRIMARY KEY(atelier_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_edition (atelier_id INT NOT NULL, edition_id INT NOT NULL, INDEX IDX_9AA843A782E2CF35 (atelier_id), INDEX IDX_9AA843A774281A5E (edition_id), PRIMARY KEY(atelier_id, edition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_ressources (atelier_id INT NOT NULL, ressources_id INT NOT NULL, INDEX IDX_A72B76CA82E2CF35 (atelier_id), INDEX IDX_A72B76CA3C361826 (ressources_id), PRIMARY KEY(atelier_id, ressources_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences_metier (competences_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_1202223CA660B158 (competences_id), INDEX IDX_1202223CED16FA20 (metier_id), PRIMARY KEY(competences_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, sponsor_id INT DEFAULT NULL, annee INT NOT NULL, INDEX IDX_A891181F12F7FB51 (sponsor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, edition_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_852BBECD74281A5E (edition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_atelier (forum_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_1077555229CCBAD0 (forum_id), INDEX IDX_1077555282E2CF35 (atelier_id), PRIMARY KEY(forum_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, user_id INT DEFAULT NULL, entreprise VARCHAR(255) NOT NULL, INDEX IDX_73D0145C82E2CF35 (atelier_id), UNIQUE INDEX UNIQ_73D0145CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervenant_edition (id INT AUTO_INCREMENT NOT NULL, edition_id_id INT NOT NULL, intervenant_id_id INT NOT NULL, statut TINYINT(1) DEFAULT NULL, INDEX IDX_E18D210685FB94DF (edition_id_id), INDEX IDX_E18D21066BB3E495 (intervenant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lycee (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lyceen (id INT AUTO_INCREMENT NOT NULL, lycee_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_EF396EA7D1DC61BF (lycee_id), UNIQUE INDEX UNIQ_EF396EA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lyceen_atelier (lyceen_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_670326181E0D401B (lyceen_id), INDEX IDX_6703261882E2CF35 (atelier_id), PRIMARY KEY(lyceen_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_atelier (metier_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_ECDFFF9EED16FA20 (metier_id), INDEX IDX_ECDFFF9E82E2CF35 (atelier_id), PRIMARY KEY(metier_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, reponse VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire_edition (questionnaire_id INT NOT NULL, edition_id INT NOT NULL, INDEX IDX_F70D3618CE07E8FF (questionnaire_id), INDEX IDX_F70D361874281A5E (edition_id), PRIMARY KEY(questionnaire_id, edition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire_question (questionnaire_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_28CC40C3CE07E8FF (questionnaire_id), INDEX IDX_28CC40C31E27F6BF (question_id), PRIMARY KEY(questionnaire_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, etage INT NOT NULL, capacite_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, hashed TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_metier ADD CONSTRAINT FK_28C2C9E89B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_metier ADD CONSTRAINT FK_28C2C9E8ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB18239F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE atelier_as_metier ADD CONSTRAINT FK_6A94BCBE82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_as_metier ADD CONSTRAINT FK_6A94BCBEED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_edition ADD CONSTRAINT FK_9AA843A782E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_edition ADD CONSTRAINT FK_9AA843A774281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_ressources ADD CONSTRAINT FK_A72B76CA82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_ressources ADD CONSTRAINT FK_A72B76CA3C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_metier ADD CONSTRAINT FK_1202223CA660B158 FOREIGN KEY (competences_id) REFERENCES competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competences_metier ADD CONSTRAINT FK_1202223CED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F12F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECD74281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE forum_atelier ADD CONSTRAINT FK_1077555229CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_atelier ADD CONSTRAINT FK_1077555282E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE intervenant_edition ADD CONSTRAINT FK_E18D210685FB94DF FOREIGN KEY (edition_id_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE intervenant_edition ADD CONSTRAINT FK_E18D21066BB3E495 FOREIGN KEY (intervenant_id_id) REFERENCES intervenant (id)');
        $this->addSql('ALTER TABLE lyceen ADD CONSTRAINT FK_EF396EA7D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('ALTER TABLE lyceen ADD CONSTRAINT FK_EF396EA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lyceen_atelier ADD CONSTRAINT FK_670326181E0D401B FOREIGN KEY (lyceen_id) REFERENCES lyceen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lyceen_atelier ADD CONSTRAINT FK_6703261882E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9EED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9E82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_edition ADD CONSTRAINT FK_F70D3618CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_edition ADD CONSTRAINT FK_F70D361874281A5E FOREIGN KEY (edition_id) REFERENCES edition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C3CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C31E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_metier DROP FOREIGN KEY FK_28C2C9E89B0F88B1');
        $this->addSql('ALTER TABLE activite_metier DROP FOREIGN KEY FK_28C2C9E8ED16FA20');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB18239F7E4405');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823DC304035');
        $this->addSql('ALTER TABLE atelier_as_metier DROP FOREIGN KEY FK_6A94BCBE82E2CF35');
        $this->addSql('ALTER TABLE atelier_as_metier DROP FOREIGN KEY FK_6A94BCBEED16FA20');
        $this->addSql('ALTER TABLE atelier_edition DROP FOREIGN KEY FK_9AA843A782E2CF35');
        $this->addSql('ALTER TABLE atelier_edition DROP FOREIGN KEY FK_9AA843A774281A5E');
        $this->addSql('ALTER TABLE atelier_ressources DROP FOREIGN KEY FK_A72B76CA82E2CF35');
        $this->addSql('ALTER TABLE atelier_ressources DROP FOREIGN KEY FK_A72B76CA3C361826');
        $this->addSql('ALTER TABLE competences_metier DROP FOREIGN KEY FK_1202223CA660B158');
        $this->addSql('ALTER TABLE competences_metier DROP FOREIGN KEY FK_1202223CED16FA20');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F12F7FB51');
        $this->addSql('ALTER TABLE forum DROP FOREIGN KEY FK_852BBECD74281A5E');
        $this->addSql('ALTER TABLE forum_atelier DROP FOREIGN KEY FK_1077555229CCBAD0');
        $this->addSql('ALTER TABLE forum_atelier DROP FOREIGN KEY FK_1077555282E2CF35');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145C82E2CF35');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CA76ED395');
        $this->addSql('ALTER TABLE intervenant_edition DROP FOREIGN KEY FK_E18D210685FB94DF');
        $this->addSql('ALTER TABLE intervenant_edition DROP FOREIGN KEY FK_E18D21066BB3E495');
        $this->addSql('ALTER TABLE lyceen DROP FOREIGN KEY FK_EF396EA7D1DC61BF');
        $this->addSql('ALTER TABLE lyceen DROP FOREIGN KEY FK_EF396EA7A76ED395');
        $this->addSql('ALTER TABLE lyceen_atelier DROP FOREIGN KEY FK_670326181E0D401B');
        $this->addSql('ALTER TABLE lyceen_atelier DROP FOREIGN KEY FK_6703261882E2CF35');
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9EED16FA20');
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9E82E2CF35');
        $this->addSql('ALTER TABLE questionnaire_edition DROP FOREIGN KEY FK_F70D3618CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_edition DROP FOREIGN KEY FK_F70D361874281A5E');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C3CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C31E27F6BF');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE activite_metier');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE atelier_as_metier');
        $this->addSql('DROP TABLE atelier_edition');
        $this->addSql('DROP TABLE atelier_ressources');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE competences_metier');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE forum_atelier');
        $this->addSql('DROP TABLE intervenant');
        $this->addSql('DROP TABLE intervenant_edition');
        $this->addSql('DROP TABLE lycee');
        $this->addSql('DROP TABLE lyceen');
        $this->addSql('DROP TABLE lyceen_atelier');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_atelier');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE questionnaire_edition');
        $this->addSql('DROP TABLE questionnaire_question');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
