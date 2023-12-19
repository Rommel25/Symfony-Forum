<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219132817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervenant_edition (id INT AUTO_INCREMENT NOT NULL, edition_id_id INT NOT NULL, intervenant_id_id INT NOT NULL, statut TINYINT(1) DEFAULT NULL, INDEX IDX_E18D210685FB94DF (edition_id_id), INDEX IDX_E18D21066BB3E495 (intervenant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervenant_edition ADD CONSTRAINT FK_E18D210685FB94DF FOREIGN KEY (edition_id_id) REFERENCES edition (id)');
        $this->addSql('ALTER TABLE intervenant_edition ADD CONSTRAINT FK_E18D21066BB3E495 FOREIGN KEY (intervenant_id_id) REFERENCES intervenant (id)');
        $this->addSql('DROP TABLE lyceen');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lyceen (id INT AUTO_INCREMENT NOT NULL, lycee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE intervenant_edition DROP FOREIGN KEY FK_E18D210685FB94DF');
        $this->addSql('ALTER TABLE intervenant_edition DROP FOREIGN KEY FK_E18D21066BB3E495');
        $this->addSql('DROP TABLE intervenant_edition');
    }
}
