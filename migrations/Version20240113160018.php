<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240113160018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questionnaire_as_question (questionnaire_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_10B9042FCE07E8FF (questionnaire_id), INDEX IDX_10B9042F1E27F6BF (question_id), PRIMARY KEY(questionnaire_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, lyceen_id INT DEFAULT NULL, questions_id INT DEFAULT NULL, reponse VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC71E0D401B (lyceen_id), INDEX IDX_5FB6DEC7BCB134CE (questions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questionnaire_as_question ADD CONSTRAINT FK_10B9042FCE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_as_question ADD CONSTRAINT FK_10B9042F1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC71E0D401B FOREIGN KEY (lyceen_id) REFERENCES lyceen (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7BCB134CE FOREIGN KEY (questions_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C31E27F6BF');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C3CE07E8FF');
        $this->addSql('DROP TABLE questionnaire_question');
        $this->addSql('ALTER TABLE question DROP reponse');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questionnaire_question (questionnaire_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_28CC40C31E27F6BF (question_id), INDEX IDX_28CC40C3CE07E8FF (questionnaire_id), PRIMARY KEY(questionnaire_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C31E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C3CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_as_question DROP FOREIGN KEY FK_10B9042FCE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_as_question DROP FOREIGN KEY FK_10B9042F1E27F6BF');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC71E0D401B');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7BCB134CE');
        $this->addSql('DROP TABLE questionnaire_as_question');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('ALTER TABLE question ADD reponse VARCHAR(2000) NOT NULL');
    }
}
